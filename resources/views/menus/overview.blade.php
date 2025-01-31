@extends('layouts.app')
@section('content')
    <div class="lg:flex lg:flex-row gap-6 p-6 min-h-screen">
        <div class="bg-white lg:w-3/4 md:w-full rounded-lg shadow-lg p-6 mb-6 lg:mb-0">
            <p class="text-lg text-indigo-600">Good Morning,</p>
            <p class="text-3xl font-semibold text-indigo-800 mb-6">{{ Auth::user()->username }}!</p>
            <div class="flex items-center mb-6">
                <i class="far fa-calendar-alt text-indigo-500 mr-2"></i>
                <div class="text-sm text-indigo-600">
                    {{ $currentDate }}
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div
                    class="bg-gradient-to-r from-blue-200 to-blue-300 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                    <p class="text-sm text-indigo-700 mb-1">Masuk</p>
                    <p class="text-xl font-semibold text-indigo-900">07:30</p>
                </div>
                <div
                    class="bg-gradient-to-r from-purple-200 to-purple-300 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                    <p class="text-sm text-indigo-700 mb-1">Keluar</p>
                    <p class="text-xl font-semibold text-indigo-900">17:00</p>
                </div>
                <div
                    class="bg-gradient-to-r from-pink-200 to-pink-300 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                    <p class="text-sm text-indigo-700 mb-1">Total Hadir</p>
                    <p class="text-xl font-semibold text-indigo-900">15 Hari</p>
                </div>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-indigo-800 mb-4">History</h3>
                <div class="bg-gradient-to-r from-green-100 to-blue-100 rounded-lg p-4 mb-4">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-16 h-16 bg-indigo-200 rounded-full flex items-center justify-center mb-2 md:mb-0">
                            <p class="text-sm font-semibold text-indigo-600">2 Jan</p>
                        </div>
                        <div class="flex flex-col items-center mb-2 md:mb-0">
                            <p class="text-sm text-indigo-600">Masuk</p>
                            <p class="font-semibold text-indigo-800">07:30</p>
                        </div>
                        <div class="flex flex-col items-center mb-2 md:mb-0">
                            <p class="text-sm text-indigo-600">Keluar</p>
                            <p class="font-semibold text-indigo-800">17:00</p>
                        </div>
                        <div class="flex flex-col items-center mb-2 md:mb-0">
                            <p class="text-sm text-indigo-600">Jam Total</p>
                            <p class="font-semibold text-indigo-800">8:30</p>
                        </div>
                    </div>
                    <div class="flex justify-center mt-2">
                        <div class="text-sm ml-12 text-indigo-600">ITB Jatinangor</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 sticky top-20 md:w-full lg:w-[30vw]">
            <h3 class="text-xl font-semibold text-indigo-800 mb-4">Calendar</h3>
            <div class="flex justify-between items-center mb-4">
                <button id="prevMonth" class="text-indigo-600 hover:text-indigo-800">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="nextMonth" class="text-indigo-600 hover:text-indigo-800">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="h-auto overflow-hidden">
                <div id="calendar" class="bg-gradient-to-br from-indigo-100 to-purple-100 p-4 rounded-lg w-full">
                    <!-- Calendar will be generated here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');
            const today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();

            const apiKey = 'YOUR_API_KEY'; // Ganti dengan API key Anda

            async function fetchHolidays(month, year) {
                try {
                    const response = await fetch(
                        `https://holidayapi.com/v1/holidays?key=${apiKey}&country=ID&year=${year}&month=${month + 1}`
                    );
                    if (response.ok) {
                        const data = await response.json();
                        console.log('Holidays fetched:', data.holidays); // Debugging
                        return data.holidays || [];
                    } else {
                        console.error('Failed to fetch holidays:', response.statusText);
                        return [];
                    }
                } catch (error) {
                    console.error('Error fetching holidays:', error);
                    return [];
                }
            }

            function generateCalendar(month, year, holidays) {
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                let html =
                    `<h4 class="text-center font-semibold text-indigo-800 mb-2">${firstDay.toLocaleString('default', { month: 'long' })} ${year}</h4>`;
                html += '<div class="grid grid-cols-7 gap-1">';
                const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                daysOfWeek.forEach(day => {
                    html += `<div class="text-center text-indigo-600 font-semibold">${day}</div>`;
                });
                for (let i = 0; i < firstDay.getDay(); i++) {
                    html += '<div></div>';
                }
                for (let i = 1; i <= lastDay.getDate(); i++) {
                    const isToday = i === today.getDate() && month === today.getMonth() && year === today
                        .getFullYear();
                    const dateKey =
                        `${year}-${(month + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
                    const isHoliday = holidays.some(holiday => holiday.date === dateKey);
                    html += `<div class="text-center p-1 ${
                isToday ? 'bg-blue-500 text-white' : isHoliday ? 'bg-red-500 text-white' : 'hover:bg-indigo-200'
            } rounded-full">${i}</div>`;
                }
                html += '</div>';
                return html;
            }

            async function updateCalendar() {
                const holidays = await fetchHolidays(currentMonth, currentYear);
                const calendarHtml = generateCalendar(currentMonth, currentYear, holidays);
                calendarEl.innerHTML = calendarHtml;
            }

            prevMonthBtn.addEventListener('click', () => {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                updateCalendar();
            });

            nextMonthBtn.addEventListener('click', () => {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                updateCalendar();
            });

            updateCalendar();
        });
    </script>
@endsection
