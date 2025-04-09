@extends('layouts.app')
@section('content')
    <div class="lg:flex lg:flex-row gap-6 {{ Auth::user()->hasRole('admin') ? 'px-6' : 'p-6' }}  min-h-screen">
        @if (Auth::user()->hasRole('admin'))
        <div class="w-full flex flex-col gap-6">
            <div class="flex w-full gap-x-4 items-center">
                <div class="bg-gray-800 rounded-2xl shadow-lg w-1/3 h-64 p-4">
                    <div class="w-full justify-between flex flex-col">
                        <div class="flex w-full justify-between items-center">
                            <h4 class="text-lg font-bold text-white">Calendar</h4>
                            <div class="flex justify-between items-center gap-2">
                                <button id="prevMonth" class="text-white hover:text-gray-300">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button id="nextMonth" class="text-white hover:text-gray-300">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-4 h-auto overflow-hidden">
                            <div id="calendar" class="">
                                <div class="grid grid-cols-7 text-center text-xs text-gray-500">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="grid grid-cols-7 text-center mt-2 text-white">
                                    <div>1</div>
                                    <div>2</div>
                                    <div>3</div>
                                    <div>4</div>
                                    <div>5</div>
                                    <div>6</div>
                                    <div>7</div>
                                    <div>8</div>
                                    <div>9</div>
                                    <div>10</div>
                                    <div>11</div>
                                    <div>12</div>
                                    <div>13</div>
                                    <div>14</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-4 w-2/3 h-64">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">Recent Activities</h3>
                    <ul class="list-disc pl-5">
                        @foreach ($recentActivities as $activity)
                            <li class="text-sm text-gray-600 mb-2">{{ $activity->description.' at '.$activity->created_at->format('H:i A') }}</li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        <a class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">View All Activities</a>
                    </div>
                </div>
            </div>
            <div class="flex w-full gap-x-4 items-center">
                <div class="bg-zinc-200 rounded-2xl shadow-lg p-6 w-2/3 h-64">
                    <canvas id="attendanceChart"></canvas>
                </div>
                <div class="w-1/3 h-64 flex flex-col gap-4">
                    <div class="bg-amber-100 rounded-2xl shadow-lg p-6 h-1/2">
                        <h4 class="text-lg font-bold text-gray-800">Present Today</h4>
                        <p class="text-2xl font-semibold text-green-600">{{ $present }}</p>
                    </div>
                    <div class="bg-amber-100 rounded-2xl shadow-lg p-6 h-1/2">
                        <h4 class="text-lg font-bold text-gray-800">Absent Today</h4>
                        <p class="text-2xl font-semibold text-red-600">{{ $absent }}</p>
                    </div>
                </div>
            </div>
            <div class="flex w-full gap-x-4 items-center">
                <div class="bg-white rounded-2xl shadow-lg p-6 w-1/2 h-64">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">User Statistics</h3>
                    <div class="flex justify-around">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Total Students</h4>
                            <p class="text-2xl font-semibold text-blue-600">{{ $totalStudents }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Active Students</h4>
                            <p class="text-2xl font-semibold text-green-600">{{ $activeStudents }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Inactive Students</h4>
                            <p class="text-2xl font-semibold text-red-600">{{ $inactiveStudents }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-6 w-1/2 h-64">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">Dues Statistics</h3>
                    <div class="flex justify-around">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Total Dues This Month</h4>
                            <p class="text-2xl font-semibold text-blue-600">Rp {{ number_format($totalDuesThisMonth, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Unpaid Students</h4>
                            <p class="text-2xl font-semibold text-red-600">{{ $unpaidStudents }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-full gap-x-4 items-center">
                <div class="bg-zinc-200 rounded-2xl shadow-lg p-6 w-full h-64">
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">Job Vacancies</h3>
                    <div class="flex justify-between">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Total Job Vacancies</h4>
                            <p class="text-2xl font-semibold text-blue-600">{{ $jobVacancies }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Latest Jobs</h4>
                            <ul class="list-disc pl-5">
                                @foreach ($latestJobs as $job)
                                    <li class="text-sm text-gray-600 mb-2">{{ $job->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                fetch('/attendance/today')
                    .then(response => response.json())
                    .then(data => {
                        const ctx = document.getElementById('attendanceChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Present', 'Absent'],
                                datasets: [{
                                    data: [data.present, data.absent],
                                    backgroundColor: ['#4CAF50', '#FF5252'],
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                            }
                        });
                    });
            });
        </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const calendarEl = document.getElementById('calendar');
                    const today = new Date();
                    let currentMonth = today.getMonth();
                    let currentYear = today.getFullYear();

                    function generateCalendar(month, year) {
                        const firstDay = new Date(year, month, 1);
                        const lastDay = new Date(year, month + 1, 0);
                        let html = '<div class="grid grid-cols-7 gap-1">';

                        // Days of week header starting from Monday
                        const daysOfWeek = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
                        daysOfWeek.forEach((day, index) => {
                            const isWeekend = index === 5 || index === 6; // Saturday is 5, Sunday is 6
                            html +=
                                `<div class="text-center font-semibold ${isWeekend ? 'text-red-600' : 'text-white'}">${day}</div>`;
                        });

                        // Calculate the first day of the week (Monday = 0, Sunday = 6)
                        let firstDayIndex = firstDay.getDay(); // 0 (Sunday) to 6 (Saturday)
                        firstDayIndex = firstDayIndex === 0 ? 6 : firstDayIndex - 1; // Convert to Monday = 0, Sunday = 6

                        // Empty cells for days before the first day of the month
                        for (let i = 0; i < firstDayIndex; i++) {
                            html += '<div></div>';
                        }

                        // Calendar days
                        for (let i = 1; i <= lastDay.getDate(); i++) {
                            const date = new Date(year, month, i);
                            let dayOfWeek = date.getDay();
                            dayOfWeek = dayOfWeek === 0 ? 6 : dayOfWeek - 1; // Convert to Monday = 0, Sunday = 6
                            const isWeekend = dayOfWeek === 5 || dayOfWeek === 6; // Saturday is 5, Sunday is 6
                            const isToday = i === today.getDate() && month === today.getMonth() && year === today
                                .getFullYear();

                            if (isToday) {
                                html += `<div class="text-center p-0.5 bg-blue-500 text-white rounded-full">${i}</div>`;
                            } else {
                                html +=
                                    `<div class="text-center text-sm p-0.5 ${isWeekend ? 'text-red-600' : 'text-white'} hover:bg-blue-200 rounded-full">${i}</div>`;
                            }
                        }

                        html += '</div>';
                        return html;
                    }

                    function displayCalendars(month, year) {
                        let html = '';
                        html += generateCalendar(month, year);
                        calendarEl.innerHTML = html;
                    }

                    function updateCalendar() {
                        displayCalendars(currentMonth, currentYear);
                    }

                    updateCalendar();
                });
            </script>
        @else
            <div class="bg-white lg:w-3/4 md:w-full rounded-lg shadow-lg p-6 mb-6 lg:mb-0">
                <p class="text-lg text-blue-600">Good Morning,</p>
                <p class="text-3xl font-semibold text-blue-800 mb-6">{{ Auth::user()->username }}!</p>
                <div class="flex items-center mb-6">
                    <i class="far fa-calendar-alt text-blue-500 mr-2"></i>
                    <div class="text-sm text-blue-600">
                        {{ $currentDate }}
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div
                        class="bg-gradient-to-r from-blue-200 to-blue-300 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                        <p class="text-sm text-blue-700 mb-1">Masuk</p>
                        <p class="text-xl font-semibold text-blue-900">07:30</p>
                    </div>
                    <div
                        class="bg-gradient-to-r from-purple-200 to-purple-300 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                        <p class="text-sm text-blue-700 mb-1">Keluar</p>
                        <p class="text-xl font-semibold text-blue-900">17:00</p>
                    </div>
                    <div
                        class="bg-gradient-to-r from-pink-200 to-pink-300 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                        <p class="text-sm text-blue-700 mb-1">Total Hadir</p>
                        <p class="text-xl font-semibold text-blue-900">15 Hari</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-blue-800 mb-4">History</h3>
                    <div class="bg-gradient-to-r from-green-100 to-blue-100 rounded-lg p-4 mb-4">
                        <div class="flex flex-wrap items-center justify-between">
                            <div class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center mb-2 md:mb-0">
                                <p class="text-sm font-semibold text-blue-600">2 Jan</p>
                            </div>
                            <div class="flex flex-col items-center mb-2 md:mb-0">
                                <p class="text-sm text-blue-600">Masuk</p>
                                <p class="font-semibold text-blue-800">07:30</p>
                            </div>
                            <div class="flex flex-col items-center mb-2 md:mb-0">
                                <p class="text-sm text-blue-600">Keluar</p>
                                <p class="font-semibold text-blue-800">17:00</p>
                            </div>
                            <div class="flex flex-col items-center mb-2 md:mb-0">
                                <p class="text-sm text-blue-600">Jam Total</p>
                                <p class="font-semibold text-blue-800">8:30</p>
                            </div>
                        </div>
                        <div class="flex justify-center mt-2">
                            <div class="text-sm ml-12 text-blue-600">ITB Jatinangor</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-20 md:w-full lg:w-[30vw]">
                <h3 class="text-xl font-semibold text-blue-800 mb-4">Calendar</h3>
                <div class="flex justify-between items-center mb-4">
                    <button id="prevMonth" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="nextMonth" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="h-auto overflow-hidden">
                    <div id="calendar" class="bg-gray-50 p-4 rounded-lg w-full">
                        <!-- Calendar will be generated here -->
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

                    function generateCalendar(month, year) {
                        const firstDay = new Date(year, month, 1);
                        const lastDay = new Date(year, month + 1, 0);
                        let html =
                            `<h4 class="text-center font-semibold text-blue-800 mb-2">${firstDay.toLocaleString('default', { month: 'long' })} ${year}</h4>`;
                        html += '<div class="grid grid-cols-7 gap-1">';

                        // Days of week header starting from Monday
                        const daysOfWeek = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
                        daysOfWeek.forEach((day, index) => {
                            const isWeekend = index === 5 || index === 6; // Saturday is 5, Sunday is 6
                            html +=
                                `<div class="text-center font-semibold ${isWeekend ? 'text-red-600' : 'text-blue-600'}">${day}</div>`;
                        });

                        // Calculate the first day of the week (Monday = 0, Sunday = 6)
                        let firstDayIndex = firstDay.getDay(); // 0 (Sunday) to 6 (Saturday)
                        firstDayIndex = firstDayIndex === 0 ? 6 : firstDayIndex - 1; // Convert to Monday = 0, Sunday = 6

                        // Empty cells for days before the first day of the month
                        for (let i = 0; i < firstDayIndex; i++) {
                            html += '<div></div>';
                        }

                        // Calendar days
                        for (let i = 1; i <= lastDay.getDate(); i++) {
                            const date = new Date(year, month, i);
                            let dayOfWeek = date.getDay();
                            dayOfWeek = dayOfWeek === 0 ? 6 : dayOfWeek - 1; // Convert to Monday = 0, Sunday = 6
                            const isWeekend = dayOfWeek === 5 || dayOfWeek === 6; // Saturday is 5, Sunday is 6
                            const isToday = i === today.getDate() && month === today.getMonth() && year === today
                                .getFullYear();

                            if (isToday) {
                                html += `<div class="text-center p-1 bg-blue-500 text-white rounded-full">${i}</div>`;
                            } else {
                                html +=
                                    `<div class="text-center p-1 ${isWeekend ? 'text-red-600' : ''} hover:bg-blue-200 rounded-full">${i}</div>`;
                            }
                        }

                        html += '</div>';
                        return html;
                    }

                    function displayCalendars(month, year) {
                        let html = '';
                        html += generateCalendar(month, year);
                        calendarEl.innerHTML = html;
                    }

                    function updateCalendar() {
                        displayCalendars(currentMonth, currentYear);
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
        @endif
    </div>
@endsection
