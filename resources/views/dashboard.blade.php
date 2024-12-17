<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-size: 27px; margin-left: 30px;">
            {{ __('Kalender') }}
        </h2>
    </x-slot>

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                    <!-- Tugas Baru -->
                    <a href="/tugas" style="background-color: #3F8CDF; margin-right: 20px;
                    color: white; border-radius: 8px; padding: 10px 20px; text-decoration: none;">
                    <span style="font-size: 14px;"><i class="fas fa-plus"></i></span>
                    <span style="font-size: 18px; margin-left: 5px;">Tugas Baru</span></a>

                    <!-- Kategori Baru -->
                    <a href="/kategori" style="background-color: white; color: #4fa3e8; border: 2px solid #4fa3e8;
                    padding: 10px 20px; border-radius: 8px; text-decoration: none;">
                    <span style="font-size: 14px;"><i class="fas fa-plus"></i></span>
                    <span style="font-size: 16px; margin-left: 5px;"><b>Kategori Baru</b></span></a>
                    </div>  
                    <div class="flex items-center" style="margin-left: 20px;">
                    <!-- Perubahan -->
                    <a href="/list" style="background-color: white; color:rgb(20, 45, 65); border: 2px solid rgb(20, 45, 65);
                    padding: 10px 20px; border-radius: 8px; text-decoration: none;">
                    <span style="font-size: 16px; margin-left: 5px;">Lakukan Perubahan / Lihat Detail Tugas</span></a>
                    <!-- Hari ini -->
                    <button id="todayButton" style="margin-left: 20px;" class="btn btn-primary">Lihat Kalender Hari Ini</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="flex items-center justify-between w-full">
                    <!-- Button Kiri sebelumnya -->
                    <div class="flex items-center">
                        <button id="prevYear" class="btn btn-primary"><i class="fas fa-angle-double-left"></i></button>
                        <button id="prevMonth" class="btn btn-secondary"><i class="fas fa-angle-left"></i></button>
                    </div>
                    
                    <p id="currentMonthYear" style="font-size: 30px; text-align: center; font-weight: bold;"></p>

                    <!-- Button kanan selanjutnya -->
                    <div class="flex items-center">
                        <button id="nextMonth" class="btn btn-secondary"><i class="fas fa-angle-right"></i></button>
                        <button id="nextYear" class="btn btn-primary"><i class="fas fa-angle-double-right"></i></button>
                    </div>
                </div><br>
                <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div><br><br><br>
    
    <style>
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }

        #prevYear, #nextYear {
            float: right;
            margin: 10px;
        }

        .fc-day-header {
            background-color: #4fa3e8;
            color: white;
            font-size: 20px;
            
        }

        .fc-today {
            background-color:rgb(222, 240, 255) !important;
        }

        .fc-title {
            align-items: left;
            margin-left: 10px;
        }

        .fc-event {
            background-color:rgb(0, 100, 182);
        }

        .fc-event.fc-event-selesai {
            background-color: green !important;
        }

        .fc-toolbar {
        display: none;
        }

    </style>

    <script>
        function updateMonthYearText(calendar) {
        var currentView = calendar.fullCalendar('getView'); 
        var month = currentView.title; 
        $('#currentMonthYear').text(month);
    }
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            locale: 'id',
            defaultView: 'month',
            dayNamesShort: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            buttonText: {
                today: 'Hari Ini',
            },
            monthNames: [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            viewRender: function(view) {
            updateMonthYearText($('#calendar'));
        },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: '/events',
                    method: 'GET',
                    success: function(data) {
                        var formattedEvents = data.map(function(event) {
                            event.className = event.status === 'selesai' ? 'fc-event-selesai' : ''; 
                            return event;
                        });
                        callback(formattedEvents);
                    },
                    error: function() {
                        alert('Error fetching events.');
                    }
                });
            }
        });
        updateMonthYearText(calendar);

        // hari ini
        $('#todayButton').click(function() {
        calendar.fullCalendar('today'); 
        updateMonthYearText(calendar);  
        });

        // Tahun Lalu
        $('#prevYear').click(function() {
            var currentDate = calendar.fullCalendar('getDate');
            var newDate = currentDate.subtract(1, 'year');
            calendar.fullCalendar('gotoDate', newDate);
        });

        // Tahun Depan
        $('#nextYear').click(function() {
            var currentDate = calendar.fullCalendar('getDate');
            var newDate = currentDate.add(1, 'year');
            calendar.fullCalendar('gotoDate', newDate);
        });

        // bulan lalu
        $('#prevMonth').click(function() {
            calendar.fullCalendar('prev');
        });

        // bulan depan
        $('#nextMonth').click(function() {
            calendar.fullCalendar('next');
        });
    });
    </script>
    <script>
        // Ambil elemen tombol dan elemen tujuan
        const todayButton = document.getElementById('todayButton');
        const currentMonthYear = document.getElementById('currentMonthYear');

        // Tambahkan event listener untuk klik tombol
        todayButton.addEventListener('click', function() {
            // Scroll halaman menuju elemen dengan id "currentMonthYear"
            currentMonthYear.scrollIntoView({
                behavior: 'smooth', // Efek smooth scroll
            });
        });
    </script>
</x-app-layout>