<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wood_Material;
use App\Models\Color;
use App\Models\User;
use App\Notifications\StatusUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('is-customer')) {
            abort(403);
        }
        $orders = Order::with('wood_material')->with('color')->where('user_id', Auth::id())->latest()->paginate(10);
        if($orders->onFirstPage())
            $url = url()->current();
        else
            $url = $orders->url($orders->currentPage());
        session()->put('orders-route', $url);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('is-customer')) {
            abort(403);
        }
        $wood_materials = Wood_Material::pluck('name', 'id');
        $colors = Color::all();

        return view('orders.create',compact('wood_materials', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('is-customer')) {
            abort(403);
        }
        $this->validate($request, [
            'title' => 'required|max:255',
            'color'=> 'required',
            'wood_material'=> 'required',
            'dimentions' => 'requried',
            'dimensions.*'=> 'required|numeric',
        ]);

        $order = new Order;

        $order->user_id = Auth::id();
        $order->title = $request->title;
        $order->wood_material_id = $request->wood_material;
        $order->color_id = $request->color;
        $order->dimensions = serialize($request->dimensions);
        $order->description = $request->description;
        $order->status = 0;
        $order->save();
        $adminid = DB::table('customer_admin')->where('customer_id', Auth::id())
        ->select('customer_admin.admin_id')->first();
        $admin = User::find($adminid->admin_id);
        $admin->notify(new StatusUpdate($order));

        return redirect(session('orders-route'))->with('status', 'New order added! Notification is sent to admin email.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if (! Gate::allows('is-customer')) {
            abort(403);
        }
        $order->dimensions = unserialize($order->dimensions);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function changeStatus(Order $order, Request $request) {
        if (! Gate::allows('is-admin')) {
            abort(403);
        }
        if($request->accept) {
            $this->validate($request, [
                'price' => 'required|numeric',
            ]);
            $order->price = $request->price;
            $order->status = $request->accept;
            $order->update($request->only('price', 'status'));
            $user = $order->user;
            $user->notify(new StatusUpdate($order));
            $mes = 'Order status updated to accepted! Notification is sent to customer email.';
        } elseif($request->reject) {
            $order->status = $request->reject;
            $order->update($request->only('status'));
            $user = $order->user;
            $user->notify(new StatusUpdate($order));
            $mes = 'Order status updated to rejected! Notification is sent to customer email.';
        } elseif( $request->complete ) {
            $order->status = $request->complete;
            $order->update($request->only('status'));
            $mes = 'Order status updated to completed!';
        }

       return redirect(session('orders-route'))->with('status', $mes);
    }

    public function all()
    {
        if (! Gate::allows('is-admin')) {
            abort(403);
        }

        $customerid = DB::table('customer_admin')->where('admin_id', Auth::id())
        ->pluck('customer_admin.customer_id')->toArray();


        $orders = Order::with('wood_material')
        ->with('color')
        ->whereIn('user_id', DB::table('customer_admin')
            ->where('admin_id', Auth::id())
            ->pluck('customer_admin.customer_id')
            ->toArray())
        ->latest()->
        paginate(10);

        if($orders->onFirstPage())
            $url = url()->current();
        else
            $url = $orders->url($orders->currentPage());

        session()->put('orders-route', $url);
        return view('admin.index',compact('orders'));
    }

    public function single(Order $order)
    {
        if (! Gate::allows('is-admin')) {
            abort(403);
        }
        $order->dimensions = unserialize($order->dimensions);
        return view('admin.single', compact('order'));
    }
}
