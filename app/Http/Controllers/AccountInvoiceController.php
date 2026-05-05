<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AccountInvoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AccountInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = [
            'title'  => 'transaksi',
            'list'   => route('invoice-transaction.list'),
            'create' => ['action' => route('invoice-transaction.create')],
            'delete' => ['action' => route('invoice-transaction.destroy', 0), 'message' => 'Hapus transaksi?'],
        ];

        return response()->view('panel.invitation.transaction', compact('data'));
    }

    public function list(Request $request): JsonResponse
    {
        $totalDataRecord     = AccountInvoice::count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val           = $request->input('length');
        $start_val           = $request->input('start');

        if (empty($request->input('search.value'))) {
            $datatable = AccountInvoice::with('pack', 'user')->offset($start_val)->latest()->limit($limit_val)->get();
        } else {
            $search_text         = $request->input('search.value');
            $datatable           = AccountInvoice::with('pack', 'user')
                ->where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('payment_code', 'LIKE', "%{$search_text}%")
                ->offset($start_val)->limit($limit_val)->get();
            $totalFilteredRecord = AccountInvoice::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('payment_code', 'LIKE', "%{$search_text}%")->count();
        }

        $data_val = [];
        foreach ($datatable as $key => $item) {
            $content = json_decode($item->content);
            $payment = $content->payment ?? null;

            if ($item->status === 'CONFIRMED') {
                $status = ['color' => 'bg-success', 'text' => 'selesai'];
            } elseif ($item->status === 'PENDING' && empty($payment)) {
                $status = ['color' => 'bg-info', 'text' => 'menunggu pembayaran'];
            } elseif ($item->status === 'PENDING' && !empty($payment)) {
                $status = ['color' => 'bg-warning', 'text' => 'menunggu konfirmasi'];
            } else {
                $status = ['color' => 'bg-secondary', 'text' => $item->status];
            }

            $invoiceNum = $content->invoice_number ?? '-';
            $data_val[$key]['id']    = input_check(name: "check[]", value: $item->id, class: ['form-check-input', 'check-row'], mode: 'multiple');
            $data_val[$key]['title'] = anchor(text: $invoiceNum . ':' . $item->payment_code, href: route('invoice-transaction.show', $item->id));
            $data_val[$key]['info']  = ($item->pack->title ?? '-') . ' &mdash; ' . date('d/m/Y', strtotime($item->date));
            $data_val[$key]['log']   = "<span class=\"badge {$status['color']}\">" . Str::upper($status['text']) . "</span>";
        }

        return response()->json([
            'draw'            => intval($request->input('draw')),
            'recordsTotal'    => intval($totalDataRecord),
            'recordsFiltered' => intval($totalFilteredRecord),
            'data'            => $data_val,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $invoice          = AccountInvoice::with('pack', 'user')->findOrFail($id);
        $invoice->content = json_decode($invoice->content);
        $payment          = $invoice->content->payment ?? null;

        if ($invoice->status === 'CONFIRMED') {
            $status = ['color' => 'bg-success', 'text' => 'selesai'];
        } elseif ($invoice->status === 'PENDING' && empty($payment)) {
            $status = ['color' => 'bg-info', 'text' => 'menunggu pembayaran'];
        } elseif ($invoice->status === 'PENDING' && !empty($payment)) {
            $status = ['color' => 'bg-warning', 'text' => 'menunggu konfirmasi'];
        } else {
            $status = ['color' => 'bg-secondary', 'text' => $invoice->status];
        }

        $bank = null;
        if ($invoice->payment_link === '#manual' && !empty($invoice->content->bank ?? '')) {
            $bank = Bank::select('name', 'content', 'file')
                ->whereId(base64_decode($invoice->content->bank))
                ->first();
        }

        $data = ['title' => 'transaksi'];

        return response()->view('panel.invitation.transaction-show', compact('data', 'invoice', 'bank', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $invoice          = AccountInvoice::with('pack', 'user')->findOrFail($id);
        $invoice->content = json_decode($invoice->content ?? '{}');
        $packages         = Package::select('id', 'title', 'price')->publish()->get();

        $data = ['title' => 'Edit Transaksi'];

        return response()->view('panel.invitation.transaction-edit', compact('data', 'invoice', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $accountInvoice = AccountInvoice::findOrFail($id);

        $request->validate([
            'status'     => 'required|in:PENDING,CONFIRMED',
            'date'       => 'required|date',
            'package_id' => 'required|exists:packages,id',
            'amount'     => 'required|integer|min:0',
        ], [
            'status.required'     => 'Status wajib dipilih.',
            'date.required'       => 'Tanggal wajib diisi.',
            'package_id.required' => 'Paket wajib dipilih.',
            'amount.required'     => 'Jumlah bayar wajib diisi.',
        ]);

        $accountInvoice->update([
            'status'     => $request->status,
            'date'       => $request->date,
            'package_id' => $request->package_id,
            'amount'     => (int) $request->amount,
        ]);

        return redirect()->route('invoice-transaction.show', $accountInvoice->id)
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function confirm(int $id, string $status): RedirectResponse
    {
        $invoice = AccountInvoice::findOrFail($id);

        if ($status === 'approve') {
            $invoice->update(['status' => 'CONFIRMED']);
        } elseif ($status === 'decline') {
            $prove = json_decode($invoice->content, true);
            if (!empty($prove['payment']['image'] ?? '')) {
                if (Storage::disk('public')->exists($prove['payment']['image'])) {
                    Storage::disk('public')->delete($prove['payment']['image']);
                }
            }
            $prove['payment']['date']  = null;
            $prove['payment']['image'] = null;
            $invoice->update(['content' => json_encode($prove)]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        $ids       = explode(',', $request->id);
        $ids_count = count($ids);

        foreach (AccountInvoice::whereIn('id', $ids)->get() as $item) {
            $content = json_decode($item->content);
            $image   = $content->payment->image ?? null;
            if ($image && Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
            $item->delete();
        }

        return response()->json([
            'toast'    => ['icon' => 'success', 'title' => 'Dihapus', 'html' => "<b>{$ids_count}</b> data telah dihapus"],
            'redirect' => ['type' => 'dataTables'],
        ]);
    }
}
