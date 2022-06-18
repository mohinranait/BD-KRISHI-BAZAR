<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Card;
use App\Model\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderIndex()
    {
        $orders = Order::orderby('id','desc')->get();
        return view('admin.ecommerce.order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderShow($id)
    {
        $order = Order::find($id);
        if( !empty($order)){
            $cards = Card::orderby('product_id','asc')->where('order_id',$order->id)->get();
            return view('admin.ecommerce.order.order-view',compact('order','cards'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderEdit($id)
    {
        $order = Order::find($id);
        if( !empty( $order) ){
            return view('admin.ecommerce.order.edit',compact('order'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderUpdate(Request $request, $id)
    {
        $order = Order::find($id);
        $order->name           = $request->name;
        $order->email          = $request->email;
        $order->phone          = $request->phone;
        $order->address        = $request->address;
        $order->is_paid        = $request->is_paid;
        $order->amount         = $request->amount;
        $order->payment_method = $request->payment_method;
        $order->transaction_id = $request->transaction_id;
        $order->status = $request->status;

        $order->save();
        return redirect()->route('order.index')->with('message', "Order update successfull");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
