<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $order->order_number }} - Noorea</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.4;
            color: #333;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            border-bottom: 2px solid #D4AF37;
            padding-bottom: 20px;
        }
        .company-info {
            flex: 1;
        }
        .company-logo {
            font-size: 32px;
            font-weight: bold;
            color: #D4AF37;
            margin-bottom: 10px;
        }
        .company-details {
            font-size: 12px;
            color: #666;
            line-height: 1.6;
        }
        .invoice-details {
            text-align: right;
            flex: 1;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #D4AF37;
            margin-bottom: 10px;
        }
        .invoice-meta {
            font-size: 12px;
            color: #666;
        }
        .billing-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .billing-info, .shipping-info {
            flex: 1;
            margin-right: 20px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #D4AF37;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .items-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        .items-table .text-center {
            text-align: center;
        }
        .items-table .text-right {
            text-align: right;
        }
        .totals-section {
            margin-left: auto;
            width: 300px;
        }
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .totals-table .total-row {
            font-weight: bold;
            font-size: 16px;
            background-color: #f8f9fa;
            border-top: 2px solid #D4AF37;
        }
        .status-badges {
            margin: 20px 0;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin-right: 10px;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-confirmed { background-color: #d1ecf1; color: #0c5460; }
        .status-processing { background-color: #e2e3e5; color: #383d41; }
        .status-shipped { background-color: #d4edda; color: #155724; }
        .status-delivered { background-color: #d1ecf1; color: #0c5460; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
        .payment-pending { background-color: #fff3cd; color: #856404; }
        .payment-partial { background-color: #ffeaa7; color: #6c5ce7; }
        .payment-paid { background-color: #d4edda; color: #155724; }
        .payment-refunded { background-color: #f8d7da; color: #721c24; }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .notes {
            margin: 30px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #D4AF37;
        }
        .notes-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        @media print {
            body { margin: 0; padding: 15px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="invoice-header">
        <div class="company-info">
            <div class="company-logo">NOOREA</div>
            <div class="company-details">
                Cosmétiques naturels et produits de beauté<br>
                Email: contact@noorea.com<br>
                Téléphone: +221 77 XXX XX XX<br>
                Adresse: Dakar, Sénégal
            </div>
        </div>
        <div class="invoice-details">
            <div class="invoice-title">FACTURE</div>
            <div class="invoice-meta">
                <strong>N° {{ $order->order_number }}</strong><br>
                Date: {{ $order->created_at->format('d/m/Y') }}<br>
                @if($order->confirmed_at)
                    Confirmée le: {{ $order->confirmed_at->format('d/m/Y') }}<br>
                @endif
                @if($order->tracking_number)
                    Suivi: {{ $order->tracking_number }}
                @endif
            </div>
        </div>
    </div>

    <!-- Status Badges -->
    <div class="status-badges">
        <span class="status-badge status-{{ $order->status }}">
            @switch($order->status)
                @case('pending') En attente @break
                @case('confirmed') Confirmée @break
                @case('processing') En traitement @break
                @case('shipped') Expédiée @break
                @case('delivered') Livrée @break
                @case('cancelled') Annulée @break
                @default {{ ucfirst($order->status) }}
            @endswitch
        </span>
        <span class="status-badge payment-{{ $order->payment_status }}">
            @switch($order->payment_status)
                @case('pending') Paiement en attente @break
                @case('partial') Paiement partiel @break
                @case('paid') Payé @break
                @case('refunded') Remboursé @break
                @default {{ ucfirst($order->payment_status) }}
            @endswitch
        </span>
    </div>

    <!-- Billing Information -->
    <div class="billing-section">
        <div class="billing-info">
            <div class="section-title">Informations client</div>
            <strong>{{ $order->customer_name }}</strong><br>
            @if($order->customer_email)
                Email: {{ $order->customer_email }}<br>
            @endif
            Téléphone: {{ $order->customer_phone }}
        </div>
        <div class="shipping-info">
            <div class="section-title">Adresse de livraison</div>
            {{ $order->shipping_address }}<br>
            {{ $order->city }}
            @if($order->postal_code)
                <br>{{ $order->postal_code }}
            @endif
        </div>
    </div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>SKU</th>
                <th class="text-center">Quantité</th>
                <th class="text-right">Prix unitaire</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product_name }}</strong>
                        @if($item->product && $item->product->short_description)
                            <br><small style="color: #666;">{{ Str::limit($item->product->short_description, 80) }}</small>
                        @endif
                    </td>
                    <td>{{ $item->product_sku ?: 'N/A' }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->product_price, 0, ',', ' ') }} FCFA</td>
                    <td class="text-right">{{ $item->formatted_total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals Section -->
    <div class="totals-section">
        <table class="totals-table">
            <tr>
                <td>Sous-total :</td>
                <td class="text-right">{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</td>
            </tr>
            @if($order->shipping_fee > 0)
                <tr>
                    <td>Frais de livraison :</td>
                    <td class="text-right">{{ number_format($order->shipping_fee, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endif
            <tr class="total-row">
                <td>TOTAL :</td>
                <td class="text-right">{{ $order->formatted_total }}</td>
            </tr>
        </table>
    </div>

    <!-- Notes -->
    @if($order->notes)
        <div class="notes">
            <div class="notes-title">Notes :</div>
            {{ $order->notes }}
        </div>
    @endif

    <!-- Timeline -->
    @if($order->confirmed_at || $order->shipped_at || $order->delivered_at)
        <div style="margin-top: 30px;">
            <div class="section-title">Historique de la commande</div>
            <div style="font-size: 12px; color: #666;">
                <div>• Commande créée le {{ $order->created_at->format('d/m/Y à H:i') }}</div>
                @if($order->confirmed_at)
                    <div>• Confirmée le {{ $order->confirmed_at->format('d/m/Y à H:i') }}</div>
                @endif
                @if($order->shipped_at)
                    <div>• Expédiée le {{ $order->shipped_at->format('d/m/Y à H:i') }}</div>
                @endif
                @if($order->delivered_at)
                    <div>• Livrée le {{ $order->delivered_at->format('d/m/Y à H:i') }}</div>
                @endif
            </div>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p><strong>Noorea - Cosmétiques Naturels</strong></p>
        <p>Cette facture a été générée automatiquement le {{ now()->format('d/m/Y à H:i') }}</p>
        <p>Pour toute question, contactez-nous sur WhatsApp au +221 77 XXX XX XX</p>
    </div>

    <!-- Print Button (hidden in print) -->
    <div class="no-print" style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
        <button onclick="window.print()" style="
            background-color: #D4AF37; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 5px; 
            cursor: pointer;
            font-weight: bold;
        ">
            🖨️ Imprimer
        </button>
        <button onclick="window.close()" style="
            background-color: #6c757d; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 5px; 
            cursor: pointer;
            margin-left: 10px;
        ">
            ✖️ Fermer
        </button>
    </div>
</body>
</html>
