<?php

namespace App\Http\Controllers;

use App\exports\InvoiceExport;
use App\Order;
use App\OrderLine;
use App\Product;
use App\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Artisan;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function viewOrder(Order $order)
    {
        return view('admin.order.view', compact('order'));
    }

    public function orderList()
    {

        return view('admin.order.list');
    }

    public function exportProductReport(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $product = Product::where('fid', '=', $request->product_id)->first();
        $orders = OrderLine::whereHas('order', function ($q) use ($start, $end) {
            $q->whereDate('date', '>=', $start)->whereDate('date', '<=', $end);
        })->where('product_id', '=', $request->product_id)->with('product')->with('order')->get();
        $data = [["product", "Order No", "Amount", "Comment"]];
        foreach ($orders as $order) {
            $quantity = $order->quantity;
            if ($order->product->sell_product_option == "weight_wise") {

                $quantity = $order->quantity . " gr";
            }
            $line = [$order->product->product_name_dch, $order->order_id, $quantity, $order->message];
            array_push($data, $line);
        }
        $export = new InvoiceExport($data);

        return Excel::download($export, $product->product_name_dch . " " . $start . " to " . $end . '.xlsx');
    }

    public function updateOrder(Order $order)
    {
    }

    public function okMail(Order $order)
    {

        $subject = Setting::firstOrFail()->ok_mail_subject;
        $body = Setting::firstOrFail()->ok_mail;
        $from_email = Setting::firstOrFail()->from_email;


        $email = $order->user->email;
        $data = array("body" => $body);
        Mail::send('mail', $data, function ($message) use ($subject, $email, $from_email) {
            $message->to($email)
                ->from($from_email)
                ->subject($subject);
        });
        return redirect()->route('orderList')->with('success', 'OK mail sent');
    }

    public function updateOrderStatus(Order $order, $status)
    {

        setlocale(LC_TIME, 'Dutch');
        if ($status == -1) {
            $subject = Setting::firstOrFail()->ok_mail_subject;
            $body = Setting::firstOrFail()->ok_mail;
            $body = implode($order->firstname . ' ' . $order->lastname, explode('#name', $body));
            $body = implode($order->id, explode('#id', $body));
            $body = implode($order->created_at->formatLocalized('%A %d/%b/%y '), explode('#date', $body));
            $body = implode($order->date->formatLocalized('%A %d/%b/%y ') . " on " . $order->hour . ":" . $order->minute, explode('#pickup', $body));
            $detail = "<table style='border:1px solid black;width: 100%;border-collapse: collapse;'>";
            foreach ($order->orderLines as $item) {
                $detail .= '<tr>
            <td style="padding:3px;border:1px solid black">';
                if ($item["product"]->sell_product_option == "weight_wise") {
                    $detail .= $item["quantity"] > 999 ? ($item["quantity"] / 1000) . "kg" : $item["quantity"] . "gr";
                } elseif ($item["product"]->sell_product_option == "per_unit") {
                    $detail .= $item["quantity"] . "stuk";
                } else {
                    $detail .= $item["quantity"] . "person";
                }

                $detail .= '</td>';
                $detail .= '<td style="padding:3px;border:1px solid black">' . $item->product->product_name_dch . '</td>';
                $detail .= '<td style="padding:3px;border:1px solid black">';
                if ($item["product"]->sell_product_option == "weight_wise") {
                    $detail .= '€' . number_format((float)$item["product"]->price_weight * 1000, 2, ',', '') . '/kg';
                } elseif ($item["product"]->sell_product_option == "per_unit") {
                    $detail .= '€' . number_format((float)$item["product"]->price_per_unit,
                            2, ',', '') . '/ stuk';
                } else {
                    $detail .= '€' . number_format((float)$item["product"]->price_per_person, 2, ',', '') . '/person';
                }
                $detail .= '</td>
                <td style="border:1px solid black;padding:3px;">';
                if ($item["product"]->sell_product_option == "weight_wise") {
                    $detail .= '€' . number_format((float)$item["product"]->price_weight * $item["quantity"], 2, ',', '');
                } elseif ($item["product"]->sell_product_option == "per_unit") {
                    $detail .= '€' . number_format((float)$item["product"]->price_per_unit * $item["quantity"],
                            2, ',', '');
                } else {
                    $detail .= '€' . number_format((float)$item["product"]->price_per_person * $item["quantity"], 2, ',', '');
                }
                $detail .= '</td>
        </tr>';
            }
            $detail .= '<tr>


           <td colspan="3" style="text-align:center;border:1px solid black;padding:3px;" >Totaal</td>
           <td style="border:1px solid black;padding:3px;">€' . $order->total . '</td>
           </tr></table>';
            $body = implode($detail, explode('#detail', $body));
            $body = implode('€' . $order->total, explode('#total', $body));
            $from_email = Setting::firstOrFail()->from_email;


            $email = $order->email;
            $data = array("body" => $body);
            Mail::send('mail', $data, function ($message) use ($subject, $email, $from_email) {
                $message->to($email)
                    ->from($from_email)
                    ->subject($subject);
            });

            $order->update([
                "status" => '-1'
            ]);

            return redirect()->route('orderList')->with('success', 'OK mail sent');
        }
        $order->update([
            "status" => $status
        ]);
        if ($status == 1) {
            $subject = Setting::firstOrFail()->success_mail_subject;
            $body = Setting::firstOrFail()->success_mail;
        } else if ($status == 2) {
            $subject = Setting::firstOrFail()->hold_mail_subject;
            $body = Setting::firstOrFail()->hold_mail;
        } else if ($status == 5) {
            $subject = Setting::firstOrFail()->delivery_complete_subject;
            $body = Setting::firstOrFail()->delivery_complete;
        } else if ($status == 4) {
            $subject = Setting::firstOrFail()->collection_complete_subject;
            $body = Setting::firstOrFail()->collection_complete;
        } else if ($status == 6) {
            $subject = Setting::firstOrFail()->home_delivery_subject;
            $body = Setting::firstOrFail()->home_delivery_body;
        }


        $from_email = Setting::firstOrFail()->from_email;

        $email = $order->email;
        if ($status != 0) {
            $body = implode($order->firstname . ' ' . $order->lastname, explode('#name', $body));
            $body = implode($order->id, explode('#id', $body));
            $body = implode($order->created_at->formatLocalized('%A %d/%b/%y '), explode('#date', $body));
            $body = implode($order->date->formatLocalized('%A %d/%b/%y ') . " on " . $order->hour . ":" . $order->minute, explode('#pickup', $body));
            $detail = "<table style='border:1px solid black;width: 100%;border-collapse: collapse;'>";
            foreach ($order->orderLines as $item) {
                $detail .= '<tr>
        <td style="padding:3px;border:1px solid black">';
                if ($item["product"]->sell_product_option == "weight_wise") {
                    $detail .= $item["quantity"] > 999 ? ($item["quantity"] / 1000) . "kg" : $item["quantity"] . "gr";
                } elseif ($item["product"]->sell_product_option == "per_unit") {
                    $detail .= $item["quantity"] . "stuk";
                } else {
                    $detail .= $item["quantity"] . "person";
                }

                $detail .= '</td>';
                $detail .= '<td style="padding:3px;border:1px solid black">' . $item->product->product_name_dch . '</td>';
                $detail .= '<td style="padding:3px;border:1px solid black">';
                if ($item["product"]->sell_product_option == "weight_wise") {
                    $detail .= '€' . number_format((float)$item["product"]->price_weight * 1000, 2, ',', '') . '/kg';
                } elseif ($item["product"]->sell_product_option == "per_unit") {
                    $detail .= '€' . number_format((float)$item["product"]->price_per_unit,
                            2, ',', '') . '/ stuk';
                } else {
                    $detail .= '€' . number_format((float)$item["product"]->price_per_person, 2, ',', '') . '/person';
                }
                $detail .= '</td>
            <td style="border:1px solid black;padding:3px;">';
                if ($item["product"]->sell_product_option == "weight_wise") {
                    $detail .= '€' . number_format((float)$item["product"]->price_weight * $item["quantity"], 2, ',', '');
                } elseif ($item["product"]->sell_product_option == "per_unit") {
                    $detail .= '€' . number_format((float)$item["product"]->price_per_unit * $item["quantity"],
                            2, ',', '');
                } else {
                    $detail .= '€' . number_format((float)$item["product"]->price_per_person * $item["quantity"], 2, ',', '');
                }
                $detail .= '</td>
    </tr>';
            }
            $detail .= '<tr>


       <td colspan="3" style="text-align:center;border:1px solid black;padding:3px;" >Totaal</td>
       <td style="border:1px solid black;padding:3px;">€' . $order->total . '</td>
       </tr></table>';
            $body = implode($detail, explode('#detail', $body));
            $body = implode('€' . $order->total, explode('#total', $body));
            $data = array("body" => $body);
            Mail::send('mail', $data, function ($message) use ($subject, $email, $from_email) {
                $message->to($email)
                    ->from($from_email)
                    ->subject($subject);
            });
        }
        return redirect()->route('orderList')->with('success', 'Order status updated successfully');
    }

    public function updateOrderPickup(Order $order, Request $request)
    {
        $order->date = $request->date;
        $order->hour = $request->hour;
        $order->minute = $request->minute;
        $order->save();
        $from_email = Setting::firstOrFail()->from_email;
        $subject = "Pickup time updated";
        $body = "Pickup time updated";
        $email = $order->user->email;
        $data = array("body" => $body);
        Mail::send('mail', $data, function ($message) use ($subject, $email, $from_email) {
            $message->to($email)
                ->from($from_email)
                ->subject($subject);
        });
        return redirect()->route('editOrder', $order->id)->with('success', 'Order Pickup time updated successfully');
    }

    public function editOrder(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully');
    }

    public function printOrder(Order $order)
    {
        return view('admin.order.print', compact('order'));
    }

    public function printOrderSticker(Order $order)
    {
        return view('admin.order.printSticker', compact('order'));
    }

    public function printPerOrder(Order $order)
    {
        return response()->json([
            "error" => 0,
            "message" => "",
            "data" => [
                'order_id' => $order->id,
                'name' => $order->lastname,
                'company_c' => 0,
                'amount' => $order->total,
                'address' => ($order->s_address1) ? $order->s_address1 : "",
                'remark' => '',
                'date' => date('Y-m-d h:i', strtotime($order->date)),
            ]
        ]);
    }

    public function printProducts(Order $order)
    {
        //dd($order->orderLines->product);
        $products = [];
        foreach ($order->orderLines as $orderLine) {
            $products[] = [
                'c_name' => $order->lastname,
                'company' => 0,
                'name' => $orderLine->product->product_name_dch,
                'default_price' => $orderLine->price,
                'amount' => $orderLine->price,
                'extra' => ($orderLine->message) ? $orderLine->message : "",
                'extra_field_text' => '',
                'remark' => ''
            ];
        }
        return response()->json([
            "error" => 0,
            "message" => "array",
            "data" => $products
        ]);
    }

    public function orderReport()
    {
        return view('admin.report.order', ["orders" => []]);
    }

    public function orderReportExport(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $orders = Order::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->get();
        return view('admin.report.orderPrint', compact('orders', 'start', 'end'));
        $pdf = PDF::loadView('admin.report.orderPdf', compact('orders', 'start', 'end'));

        return $pdf->download('disney.pdf');
    }

    public function orderReportResult(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $orders = Order::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->get();
        return view('admin.report.order', compact('orders', 'start', 'end'));
    }

    public function productReport()
    {
        return view('admin.report.product', ["orders" => []]);
    }

    public function productReportResult(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $orders = OrderLine::whereHas('order', function ($q) use ($start, $end) {
            $q->whereDate('date', '>=', $start)->whereDate('date', '<=', $end);
        })->with('product')->get();
        $quantities = [];
        foreach ($orders as $order) {
            if (array_key_exists($order->product_id, $quantities)) {
                $quantities[$order->product_id] = $quantities[$order->product_id] + $order->quantity;
            } else {
                $quantities[$order->product_id] = $order->quantity;
            }
        }


        //whereBetween('created_at', [$request->from, $request->to])
        return view('admin.report.product', compact('orders', 'quantities', 'start', 'end'));
    }

    public function customerReport()
    {
        return view('admin.report.customer', ["customers" => []]);
    }

    public function customerReportResult(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $orders = Order::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->with('orderLines')->get();
        $customers = [];

        foreach ($orders as $order) {
            if (!array_key_exists($order->email, $customers)) {
                $customers[$order->email] = [
                    "order" => [$order]
                ];
            } else {
                array_push($customers[$order->email]["order"], $order);
            }
        }

        return view('admin.report.customer', compact('customers', 'start', 'end'));
    }

    public function customerReportExport(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $orders = Order::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->get();
        $customers = [];

        foreach ($orders as $order) {
            if (!array_key_exists($order->email, $customers)) {
                $customers[$order->email] = [
                    "order" => [$order]
                ];
            } else {
                array_push($customers[$order->email]["order"], $order);
            }
        }
        $start = $request->start;
        $end = $request->end;
        $orders = Order::whereDate('date', '>=', $start)->whereDate('date', '<=', $end)->get();
        $customers = [];

        foreach ($orders as $order) {
            if (!array_key_exists($order->email, $customers)) {
                $customers[$order->email] = [
                    "order" => [$order]
                ];
            } else {
                array_push($customers[$order->email]["order"], $order);
            }
        }

        return view('admin.report.customerPrint', compact('customers', 'start', 'end'));
        $pdf = PDF::loadView('admin.report.orderPdf', compact('orders', 'start', 'end'));

        return $pdf->download('disney.pdf');
    }

    public function orderDataTable(Request $request)
    {
        if ($request->from && $request->to) {
            $data = Order::whereDate('date', '>=', $request->from)->whereDate('date', '<=', $request->to)->get();
        } elseif ($request->from) {
            $data = Order::whereDate('date', '>=', $request->from)->get();

        } elseif ($request->to) {
            $data = Order::whereDate('date', '<=', $request->to)->get();

        } else {
            $data = Order::latest()->get();
        }
        return Datatables::of($data)
            ->addColumn('check', function ($row) {
                return "<input type='checkbox' class='chk' value='" . $row->id . "'>";
            })
            ->addColumn('delivery_time', function ($row) {
                setlocale(LC_TIME, 'Dutch');
                return $row->date->formatLocalized('%A %d/%b/%y ') . " om " . $row->hour . ":" . $row->minute;
            })
            ->addColumn('username', function ($row) {
                $type = $row->user_id == 0 ? "<br><span class='badge badge-danger'>Gast</span>" : "";
                return $row->firstname . " " . $row->lastname;
            })
            ->addColumn('order_at', function ($row) {
                return $row->created_at->format('d/m/Y');
            })
            ->addColumn('action', function ($row) {
                $invoice = $row->give_invoice == 1 ? "<br><span class='text text-success ml-20'>Factuur</span>" : "";
                return "<div class='btn btn-group'>

                <a href='" . route('printOrderSticker', $row->id) . "' class='btn btn-sm btn-info'><i class='fas fa-qrcode'></i></a><a href='" . route('printOrder', $row->id) . "' class='btn btn-sm btn-primary'><i class='fas fa-print'></i></a><a href='" . route('editOrder', $row->id) . "' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i></a><a onclick='return confirm(" . '"Bent u zeker dat u wilt verwijderen?"' . ")' href='" . route('deleteOrder', $row->id) . "' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a></div>" . $invoice;
            })
            ->editColumn('total', function ($row) {
                return "€" . number_format((float)$row->total, 2, ',', '') . "";
            })
            ->editColumn('status', function ($row) {
                $pending = $row->status == 0 ? "selected" : "";
                $okay_email = $row->status == '-1' ? "selected" : "";
                $success = $row->status == 1 ? "selected" : "";
                $hold = $row->status == 2 ? "selected" : "";
                $collection = $row->status == 4 ? "selected" : "";
                $cancelled = $row->status == 5 ? "selected" : "";
                $home_delivery = $row->status == 6 ? "selected" : "";

                $option = '<select  class="form-control">
                    <option value="0" ' . $pending . '  >In afwachting</option>
                    <option value="-1" ' . $okay_email . ' >Bestelling ontvangen</option>
                    <option value="1" ' . $success . '  >Goedgekeurd</option>
                    <option value="2" ' . $hold . ' >On hold</option>
                    <option value="4" ' . $collection . ' >Afgerond</option>
                    <option value="5" ' . $cancelled . ' >Geannuleerd</option>
                    <option value="6" ' . $home_delivery . ' >Levering aan huis</option>
                </select><button onclick="changeStatus(' . $row->id . ',this.parentElement.children[0].value)" class="btn btn-block my-2 btn-sm btn-primary">Update</button>';
                return $option;
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }

    public function updateOrderLine(OrderLine $orderLine, Request $request)
    {
        $order = $orderLine->order;
        $quantity = $request->quantity;
        if ($orderLine->product->sell_product_option == "per_unit") {
            $price = $orderLine->product->price_per_unit * $orderLine->quantity;
            $newPrice = $orderLine->product->price_per_unit * $quantity;
        } elseif ($orderLine->product->sell_product_option == "weight_wise") {
            $price = $orderLine->product->price_weight * $orderLine->quantity;
            $newPrice = $orderLine->product->price_weight * $quantity;
        } else {
            $price = $orderLine->product->price_per_person * $orderLine->quantity;
            $newPrice = $orderLine->product->price_per_person * $quantity;
        }
        $order->total = $order->total + $newPrice - $price;
        $order->save();
        $orderLine->quantity = $quantity;
        $orderLine->save();
        return redirect()->route('editOrder', $order->id)->with('success', 'Item succesvol bijgewerkt');
    }

    public function deleteOrderLine(OrderLine $orderLine)
    {
        $order = $orderLine->order;
        if ($orderLine->product->sell_product_option == "per_unit") {
            $price = $orderLine->product->price_per_unit * $orderLine->quantity;
        } elseif ($orderLine->product->sell_product_option == "weight_wise") {
            $price = $orderLine->product->price_weight * $orderLine->quantity;
        } else {
            $price = $orderLine->product->price_per_person * $orderLine->quantity;
        }
        $order->total = $order->total - $price;
        $order->save();
        $orderLine->delete();
        return redirect()->route('editOrder', $order->id)->with('success', 'Item succesvol verwijderd');
    }

    public function print_report_product(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $product_id = $request->input('product_id');
        $orders = OrderLine::whereHas('order', function ($q) use ($start, $end) {
            $q->whereDate('date', '>=', $start)->whereDate('date', '<=', $end);
        })->where('product_id', '=', $product_id)->with('product')->with('order')->get();
        $print_list = [];
        foreach ($orders as $orderline) {
            $order = $orderline->order;
            if($orderline->order->user_id>0):
                $default_price = ($orderline->product->price_per_unit>0)?$orderline->product->price_per_unit:$orderline->product->price_weight;
            $print_list[] = [
                'id' => $order->id,
                'orders_id' => $order->id,
                'products_id' => $product_id,
                'discount' => $orderline->product->discount,
                'add_costs' => $product_id,
                'client_name' => $orderline->order->user->firstname." ".$orderline->order->user->lastname,
                'clients_id' => $orderline->product->id,
                'com_name' => "",
                'content_type' => 1,
                'default_price' => str_ireplace('.',',',$default_price),
                'extra_field' => "",
                'extra_name' => "",
                'image' => $orderline->product->image,
                'order_pickupdate' => date('Y-m-d',strtotime($order->date)),
                'order_pickuptime' => $order->hour.":".$order->minute,
                'order_remarks' => "",
                'price_per_person' => "0",
                'price_per_unit' => "0",
                'price_weight' => $orderline->product->price_weight,
                'pro_remark' => "",
                'proname' => $orderline->product->product_name_dch,
                'qty_unit' => $orderline->product->weight_unit,
                'quantity' => $orderline->quantity,
                'sub_total' => $orderline->price*$orderline->quantity,
                'total' =>str_ireplace('.',',',$order->total),
                'weight_per_unit' => $orderline->product->weight_unit,
                'weight_unit' => $orderline->product->weight_unit,
            ];
            endif;
        }
        return $print_list;
    }
}
