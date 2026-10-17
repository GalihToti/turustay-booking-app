@php
    $statusColors = [
        'pending' => 'warning',
        'confirmed' => 'primary',
        'checked_in' => 'info',
        'completed' => 'success',
        'cancelled' => 'secondary',
    ];
    $statusLabels = [
        'pending' => 'Menunggu konfirmasi',
        'confirmed' => 'Dikonfirmasi',
        'checked_in' => 'Check-in',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];
@endphp
<span class="badge text-bg-{{ $statusColors[$status] ?? 'secondary' }}">{{ $statusLabels[$status] ?? $status }}</span>
