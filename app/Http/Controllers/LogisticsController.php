<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Cargo;
use App\Models\Payment;
use App\Models\Contract;
use App\Models\Order;
use App\Models\RouteSheet;
use App\Models\DeliveryStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogisticsController extends Controller
{
    /**
     * Показать форму создания клиента и заказа.
     */
    public function createClientOrder()
    {
        $routeSheets = RouteSheet::all();
        return view('logistics.create_order', compact('routeSheets'));
    }

    /**
     * Обработка формы и создание клиента, груза, оплаты, договора и заказа.
     */
    public function storeClientOrder(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'cargo_description' => 'required|string|max:255',
            'cargo_volume' => 'required|numeric',
            'cargo_weight' => 'required|numeric',
            'delivery_level' => 'required|string|max:255',
            'payment_amount' => 'required|numeric',
            'contract_terms' => 'required|string',
            'route_sheet_id' => 'required|exists:route_sheets,id_route_sheet',
        ]);

        DB::beginTransaction();

        try {
            $client = Client::create([
                'full_name' => $request->full_name,
                'contact_info' => $request->contact_info,
            ]);

            $cargo = Cargo::create([
                'description' => $request->cargo_description,
                'volume' => $request->cargo_volume,
                'weight' => $request->cargo_weight,
            ]);

            $payment = Payment::create([
                'amount' => $request->payment_amount,
                'payment_date' => now(),
                'payment_status' => 'Ожидается',
            ]);

            $contract = Contract::create([
                'signing_date' => now(),
                'terms' => $request->contract_terms,
            ]);

            $deliveryStatus = DeliveryStatus::firstOrCreate(
                ['status_name' => $request->delivery_level],
                ['created_at' => now(), 'updated_at' => now()]
            );

            $order = Order::create([
                'id_client' => $client->id_client,
                'id_employee' => Auth::user()->id_employee,
                'id_cargo' => $cargo->id_cargo,
                'id_delivery_status' => $deliveryStatus->id_status,
                'creation_date' => now(),
                'id_contract' => $contract->id_contract,
                'id_route_sheet' => $request->route_sheet_id,
                'id_payment' => $payment->id_payment,
            ]);

            DB::commit();

            return redirect()->route('logistics.createClientOrder')->with('success', 'Заказ успешно создан.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Ошибка при создании заказа: ' . $e->getMessage()]);
        }
    }
}
