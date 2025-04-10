@extends('layouts.app')
@section('content')
    <div class="lg:flex lg:flex-row gap-6 {{ Auth::user()->hasRole('admin') ? 'px-6' : 'p-6' }}  min-h-screen">
        @if (Auth::user()->hasRole('admin'))
        <div class="w-full flex flex-col gap-6 p-6 bg-gray-50">
            <div class="flex w-full gap-x-4 items-stretch">
                <div class="bg-gradient-to-br from-blue-900 to-blue-700 rounded-2xl shadow-lg w-1/3 h-auto p-5">
                    <div class="w-full justify-between flex flex-col h-full">
                        <div class="flex w-full justify-between items-center">
                            <h4 class="text-lg font-bold text-white">Calendar</h4>
                            <div class="flex justify-between items-center gap-2">
                                <button id="prevMonth" class="text-white hover:text-gray-300 p-1 rounded-full hover:bg-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <span id="currentMonth" class="text-white font-medium"></span>
                                <button id="nextMonth" class="text-white hover:text-gray-300 p-1 rounded-full hover:bg-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-4 h-auto overflow-hidden">
                            <div id="calendar" class="">
                                <div class="grid grid-cols-7 text-center text-xs font-medium text-blue-200">
                                    <div class="py-1">Sun</div>
                                    <div class="py-1">Mon</div>
                                    <div class="py-1">Tue</div>
                                    <div class="py-1">Wed</div>
                                    <div class="py-1">Thu</div>
                                    <div class="py-1">Fri</div>
                                    <div class="py-1">Sat</div>
                                </div>
                                <div id="calendarDays" class="grid grid-cols-7 text-center mt-2 text-white gap-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 w-2/3 h-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Recent Activities</h3>
                        <span class="text-sm text-gray-500">Today</span>
                    </div>
                    <div class="overflow-y-auto max-h-48 pr-2">
                        <ul class="space-y-3">
                            @forelse ($recentActivities as $activity)
                                <li class="flex items-start space-x-3 py-2 border-b border-gray-100">
                                    <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-blue-500"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-700">{{ $activity->description }}</p>
                                        <span class="text-xs text-gray-500">{{ $activity->created_at->format('H:i A') }}</span>
                                    </div>
                                </li>
                            @empty
                                <li class="py-2 text-gray-500 text-sm">No recent activities found.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('activityLogs.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            View All Activities
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex w-full gap-x-4 items-stretch">
                <div class="bg-white rounded-2xl shadow-lg p-6 w-2/3 h-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Attendance Overview</h3>
                        <select id="chartPeriod" class="text-sm border border-gray-300 rounded-md px-2 py-1">
                            <option value="week">This Week</option>
                            <option value="month" selected>This Month</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                    <div class="h-48 relative">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

                <div class="w-1/3 h-auto flex flex-col gap-4">
                    <div class="bg-white rounded-2xl shadow-lg p-5 h-1/2 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Present Today</h4>
                                <p class="text-2xl font-bold text-gray-800">{{ $present }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    @if(isset($presentPercentage))
                                        <span class="text-green-500">{{ $presentPercentage }}%</span> of total students
                                    @else
                                        Students in attendance
                                    @endif
                                </p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg p-5 h-1/2 border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Absent Today</h4>
                                <p class="text-2xl font-bold text-gray-800">{{ $absent }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    @if(isset($absentPercentage))
                                        <span class="text-red-500">{{ $absentPercentage }}%</span> of total students
                                    @else
                                        Students not in attendance
                                    @endif
                                </p>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex w-full gap-x-4 items-stretch">
                <div class="bg-white rounded-2xl shadow-lg p-6 w-1/2 h-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Student Statistics</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-blue-50 p-4 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-gray-500">Total Students</h4>
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalStudents }}</p>
                            <p class="text-xs text-gray-500 mt-1">Enrolled students</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-gray-500">Active Students</h4>
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $activeStudents }}</p>
                            <p class="text-xs text-gray-500 mt-1">Currently active</p>
                        </div>
                        <div class="bg-red-50 p-4 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-gray-500">Inactive Students</h4>
                                <div class="bg-red-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $inactiveStudents }}</p>
                            <p class="text-xs text-gray-500 mt-1">Currently inactive</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            @php
                                $activePercentage = $totalStudents > 0 ? ($activeStudents / $totalStudents) * 100 : 0;
                            @endphp
                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $activePercentage }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs text-gray-500">
                            <span>{{ number_format($activePercentage, 1) }}% Active</span>
                            <span>{{ number_format(100 - $activePercentage, 1) }}% Inactive</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 w-1/2 h-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Dues Statistics</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-4 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-gray-500">Total Dues This Month</h4>
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalDuesThisMonth, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Total amount due</p>
                        </div>
                        <div class="bg-red-50 p-4 rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-gray-500">Unpaid Students</h4>
                                <div class="bg-red-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $unpaidStudents }}</p>
                            <p class="text-xs text-gray-500 mt-1">Students with unpaid dues</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        @php
                            $paidStudents = $totalStudents - $unpaidStudents;
                            $paidPercentage = $totalStudents > 0 ? ($paidStudents / $totalStudents) * 100 : 0;
                        @endphp
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $paidPercentage }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs text-gray-500">
                            <span>{{ number_format($paidPercentage, 1) }}% Paid</span>
                            <span>{{ number_format(100 - $paidPercentage, 1) }}% Unpaid</span>
                        </div>
                    </div>
                    <div class="mt-6 text-right">
                        <a href="" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Manage Dues
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex w-full gap-x-4 items-stretch">
                <div class="bg-white rounded-2xl shadow-lg p-6 w-full h-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Job Vacancies</h3>
                        <a href="{{ route('job.view') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 p-4 rounded-xl">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-gray-800">Total Job Vacancies</h4>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-3xl font-bold text-gray-800">{{ $jobVacancies }}</p>
                            <p class="text-sm text-gray-500 mt-1">Open positions</p>
                        </div>
                        <div class="md:col-span-2">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Latest Jobs</h4>
                            <div class="space-y-3 overflow-y-auto max-h-40 pr-2">
                                @forelse ($latestJobs as $job)
                                    <div class="bg-gray-50 p-3 rounded-lg border-l-4 border-blue-500">
                                        <h5 class="font-medium text-gray-800">{{ $job->title }}</h5>
                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-xs text-gray-500">{{ $job->company }}</span>
                                            <a href="" class="text-xs text-blue-600 hover:text-blue-800">View Details</a>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-sm">No job vacancies available at the moment.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendarDays = document.getElementById('calendarDays');
                const currentMonthElement = document.getElementById('currentMonth');
                const prevMonthBtn = document.getElementById('prevMonth');
                const nextMonthBtn = document.getElementById('nextMonth');

                let currentDate = new Date();
                let currentMonth = currentDate.getMonth();
                let currentYear = currentDate.getFullYear();

                function renderCalendar() {
                    calendarDays.innerHTML = '';

                    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                                       'July', 'August', 'September', 'October', 'November', 'December'];
                    currentMonthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;

                    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
                    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

                    for (let i = 0; i < firstDay; i++) {
                        const emptyDay = document.createElement('div');
                        emptyDay.classList.add('text-gray-400', 'opacity-50');
                        calendarDays.appendChild(emptyDay);
                    }

                    for (let day = 1; day <= daysInMonth; day++) {
                        const dayElement = document.createElement('div');
                        dayElement.textContent = day;
                        dayElement.classList.add('py-1', 'text-sm');

                        if (day === currentDate.getDate() &&
                            currentMonth === currentDate.getMonth() &&
                            currentYear === currentDate.getFullYear()) {
                            dayElement.classList.add('bg-white', 'text-blue-800', 'rounded-full', 'font-bold');
                        }

                        dayElement.classList.add('hover:bg-blue-600', 'hover:rounded-full', 'cursor-pointer');

                        calendarDays.appendChild(dayElement);
                    }
                }

                renderCalendar();

                prevMonthBtn.addEventListener('click', function() {
                    currentMonth--;
                    if (currentMonth < 0) {
                        currentMonth = 11;
                        currentYear--;
                    }
                    renderCalendar();
                });

                nextMonthBtn.addEventListener('click', function() {
                    currentMonth++;
                    if (currentMonth > 11) {
                        currentMonth = 0;
                        currentYear++;
                    }
                    renderCalendar();
                });

                fetch('/attendance/chart-data')
                    .then(response => response.json())
                    .then(data => {
                        const ctx = document.getElementById('attendanceChart').getContext('2d');

                        const attendanceChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Present', 'Absent'],
                                datasets: [{
                                    data: [data.present, data.absent],
                                    backgroundColor: ['#10B981', '#EF4444'],
                                    borderColor: ['#10B981', '#EF4444'],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutout: '70%',
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const label = context.label || '';
                                                const value = context.raw || 0;
                                                const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                                                const percentage = Math.round((value / total) * 100);
                                                return `${label}: ${value} (${percentage}%)`;
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        document.getElementById('chartPeriod').addEventListener('change', function() {
                            const period = this.value;
                            fetch(`/attendance/chart-data?period=${period}`)
                                .then(response => response.json())
                                .then(newData => {
                                    attendanceChart.data.datasets[0].data = [newData.present, newData.absent];
                                    attendanceChart.update();
                                });
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching attendance data:', error);
                        const ctx = document.getElementById('attendanceChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Present', 'Absent'],
                                datasets: [{
                                    data: [{{ $present }}, {{ $absent }}],
                                    backgroundColor: ['#10B981', '#EF4444'],
                                    borderColor: ['#10B981', '#EF4444'],
                                    borderWidth: 1,
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutout: '70%',
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20
                                        }
                                    }
                                }
                            }
                        });
                    });
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
