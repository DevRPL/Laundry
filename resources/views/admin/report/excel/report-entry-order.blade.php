<html>
    <style>
        td {
            border: 1px solid #000;
        }

        .no-border {
            border: none;
        }

        tr.head td {
            font-weight: bold;
        }

        .bold {
            font-weight: bold;
        }

        .title {
            font-weight: bold;
            font-size: 18;
        }

    </style>
    <table>
        <tr></tr>
        <tr>
            <td class="no-border title"><b>Periode</b></td>
            <td class="no-border title">{{ $periode['start_date'] }}</td>
            <td class="no-border title"><b>Sampai</b></td>
            <td class="no-border title">{{ $periode['end_date'] }}</td>
        </tr>
        <tr></tr>
        <tr style="text-align:center;" class="head">
            <th>No Order</th>
            <th>Paket</th>
            <th>Status Pembayaran</th>
            <th>Tarif</th>
            <th>Harga</th>
            <th>Tgl Transaksi</th>
            <th>Jam Order</th>
            <th>Tgl Ambil</th>
            <th>Berat</th>
            <th>Pengguna</th>
            <th>Customer</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Status Order</th>
        </tr>
        @forelse($entry_orders as $no => $entry_order)
            <tr>
                <td>{{ $entry_order->order_number }}</td>
                <td>{{ $entry_order->package->name  }}</td>
                <td>
                    @if ($entry_order->status == 'Lunas')
                        <span class="kt-badge kt-badge--inline kt-badge--primary">Lunas</span>
                    @else 
                        <span class="kt-badge kt-badge--inline kt-badge--info">Belum Lunas</span>
                    @endif
                </td>
                <td>{{ $entry_order->price }}</td>
                <td>{{ $entry_order->package->price }}</td>
                <td>{{ Carbon\Carbon::parse($entry_order->created_at)->format('d-m-Y') }}</td>
                <td>{{ Carbon\Carbon::parse($entry_order->created_at)->format('H:i:s') }}</td>
                <td>{{ Carbon\Carbon::parse($entry_order->date_take)->format('d-m-Y') }}</td>
                <td>{{ $entry_order->weight }}</td>
                <td>{{ $entry_order->user->name ?? '' }}</td>
                <td>{{ $entry_order->customer->name }}</td>
                <td>{{ $entry_order->customer->address }}</td>
                <td>{{ $entry_order->customer->phone }}</td>
                <td>
                    @if ($entry_order->status_order == 'Selesai')
                        <span class="kt-badge kt-badge--inline kt-badge--success">Selesai</span>
                    @elseif ($entry_order->status_order == 'Ambil')
                        <span class="kt-badge kt-badge--inline kt-badge--success">Ambil</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforelse
    </table>
</html>
