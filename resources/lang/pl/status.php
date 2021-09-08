<?php

return [
    \App\Models\Payments\Payment::$statuses['STARTED'] => 'Rozpoczęto',
    \App\Models\Payments\Payment::$statuses['PAID'] => 'Opłacono',
    \App\Models\Payments\Payment::$statuses['PENDING'] => 'W trakcie realizacji',
    \App\Models\Payments\Payment::$statuses['CANCEL'] => 'Odrzucono'
];
