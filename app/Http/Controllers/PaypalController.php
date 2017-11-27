<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;


use App\Order;
use App\OrderItem;

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        // setup PayPal api context
    }

    public function postPayment()
    {
    }

    public function getPaymentStatus()
    {
        if (true) { // payment made
            // Registrar el pedido --- ok
            // Registrar el Detalle del pedido  --- ok
            // Eliminar carrito
            // Enviar correo a user
            // Enviar correo a admin
            // Redireccionar
            $this->saveOrder(\Session::get('cart'));
            \Session::forget('cart');
            Auth::logout();
            return \Redirect::route('login')
                ->with('message', 'Compra realizada de forma correcta');
        }
        return \Redirect::route('welcome.index')
            ->with('message', 'La compra fue cancelada');
    }

    protected function printerOrden()
    {
        /*  $profile = CapabilityProfile::load("SP2000");
          $connector = new WindowsPrintConnector("tg2480h");
          $printer = new Printer($connector);

          //  dd($printer);
          try {
              $printer->setJustification(Printer::JUSTIFY_CENTER);
              $printer ->text("Sun Casino Colombia S.A.S\n");
              $printer->text("Nombre del cliente: ".\Auth::user()->name);
              $printer->text("Numero de factura: ".$order->id);
              $printer->feed(5);
              $printer->cut();
              $connector->write("\x1b"."\x69");
          } catch (Exception $e) {
              dd($e);
          } finally {
              $printer -> close();
          }*/
    }

    protected function saveOrder()
    {
        $subtotal = 0;
        $cart = \Session::get('cart');
        $shipping = 100;
        //  $this->printerOrden();
        foreach ($cart as $product) {
            $subtotal += $product->quantity * $product->points;
        }
        $order = Order::create([
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'user_id' => \Auth::user()->id
        ]);
        User::where('id', Auth::user()->id)->update(['points' => Auth::user()->points - $subtotal]);
        foreach ($cart as $product) {
            $this->saveOrderItem($product, $order->id);
            $profile = CapabilityProfile::load("SP2000");
            $connector = new WindowsPrintConnector("TG2480H");//TG2480-H "smb://guest:123456@".\Request::ip()."/tg2480-h"
            $printer = new Printer($connector);
            $now = new \DateTime();
            //dd($product->price);
            //  dd($printer);
            try {
                //   $connector->write("\x1b"."Sun Casino Colombia S.A.S\n"."\x44");
                //$printer->selectPrintMode(Printer::MODE_FONT_B);
                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->text("Sun Casinos Colombia S.A.S\n");
                $printer->text("Fecha Impresion:\n");
                $printer->text($now->format('d-m-Y H:i:s'));
                $printer->feed(1);
                $printer->text("Nombre del cliente: \n" . \Auth::user()->name . "\n");
                $printer->text("Numero de Cortesia: \n" . $order->id . "\n");
                $printer->text("Nombre del producto: \n" . $product->name . "\n");
                $printer->text("Cantidad de producto: \n");
                $printer->text( "(".$product->quantity. "X)\n");
                $printer->feed(2);
                if ($product->price==1){
                    $printer->text("PRODUCTO PARA LLEVAR \n");
                }else{

                    $printer->text("PARA CONSUMIR AQUÍ\n");
                }
                $printer->feed(2);
                $printer->barcode($order->id, Printer::BARCODE_CODE39);
                $printer->feed(2);
                $printer->text("Gracias por redimir sus puntos\n");
                $printer->text("Este ticket es personal\n");
                $printer->text("e intransferible\n");
                $printer->feed(8);
                //$printer ->text("Puntos Restantes:"."515\n");
                //  $printer->feed(5);
            } catch (Exception $e) {
                dd($e);
            } finally {
                $connector->write("\x1b" . "\x69");
                $printer->close();
            }
        }
    }

    protected function saveOrderItem($product, $order_id)
    {

        OrderItem::create([
            'points' => $product->points,
            'quantity' => $product->quantity,
            'product_id' => $product->id,
            'order_id' => $order_id
        ]);

    }
}
