<h5 class="mb-3 text-end">{{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}</h5>
<div class="calendar-container" style="font-size: 12px;">
    <div class="d-none d-md-grid" style="grid-template-columns: repeat(7, 1fr); display: grid; text-align: center; font-weight: bold;">
        <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
    </div>
    <div class="calendar-grid" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 1px; text-align: center;">
        @php $day = 1; @endphp
        @for ($i = 0; $i < $startOfMonth; $i++)
            <div class="border py-2">&nbsp;</div>
        @endfor
        @for (; $day <= $daysInMonth; $day++)
            <div class="border py-2 {{ ($day == $currentDay && $month == $currentMonth && $year == $currentYear) ? 'bg-primary text-white' : '' }}">
                {{ $day }}
            </div>
        @endfor
        @php
            $filledCells = $startOfMonth + $daysInMonth;
            $remainingCells = (ceil($filledCells / 7) * 7) - $filledCells;
        @endphp
        @for ($i = 0; $i < $remainingCells; $i++)
            <div class="border py-2">&nbsp;</div>
        @endfor
    </div>
</div>
