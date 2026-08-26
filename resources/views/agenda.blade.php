<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Agenda</title>

    <!-- FullCalendar CSS & JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales/id.global.min.js"></script>
    <!-- jQuery via CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            max-width: 950px;
            margin: 40px auto;
            padding: 0 20px;
            background-color: #f9fafb;
            color: #1f2937;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #111827;
        }

        /* ===== Search box ===== */
        #search-box {
            margin-bottom: 24px;
            display: flex;
            gap: 8px;
        }

        #search {
            flex: 1;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.15s ease;
            background: #fff;
        }

        #search:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        #search-btn {
            padding: 10px 20px;
            background: #16a34a;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            transition: background 0.15s ease;
        }

        #search-btn:hover {
            background: #15803d;
        }

        #search-btn:active {
            transform: scale(0.98);
        }

        #search-notification {
            display: none;
            margin: -16px 0 24px;
            color: #dc2626;
            font-size: 0.85rem;
        }

        /* ===== Calendar wrapper ===== */
        <div class="calendar-wrapper">

    <div class="calendar-header-custom">
        <h2 id="calendar-month-title">Agustus 2026</h2>

        <div class="calendar-navigation">
            <button type="button" id="today-btn">Hari Ini</button>
            <button type="button" id="prev-btn">‹</button>
            <button type="button" id="next-btn">›</button>
        </div>
    </div>

    <div id="calendar"></div>

</div>
        #loading-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 0.9rem;
            color: #6b7280;
            z-index: 10;
        }

        #calendar {
            max-width: 100%;
        }

        /* ===== FullCalendar overrides ===== */
        .fc {
            font-size: 0.9rem;
        }

        .fc .fc-toolbar {
    position: relative;
}

.fc .fc-toolbar-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #111827;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    margin: 0;
}
        }

        .fc .fc-button {
            background: #16a34a;
            border-color: #16a34a;
            color: #fff;
            font-weight: 500;
            text-transform: capitalize;
            box-shadow: none;
        }

        .fc .fc-button:hover {
            background: #15803d;
            border-color: #15803d;
        }

        .fc .fc-button:disabled {
            background: #16a34a;
            border-color: #16a34a;
            opacity: 0.6;
        }

        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):active {
            background: #15803d;
            border-color: #15803d;
            color: #fff;
        }

        .fc-col-header-cell {
            background-color: #f9fafb;
            font-weight: 600;
            color: #4b5563;
            padding: 8px 0;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.03em;
        }

        .fc-col-header-cell.fc-day-sat,
        .fc-col-header-cell.fc-day-sun {
            color: #dc2626;
        }

        .fc-daygrid-day-number {
            padding: 6px 8px;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
        }

        .fc-day-sat .fc-daygrid-day-number,
        .fc-day-sun .fc-daygrid-day-number {
            color: #dc2626;
        }

        .fc-day-today {
            background-color: #fef3c7 !important;
        }

        .fc-day-today .fc-daygrid-day-number {
            color: #b45309;
            font-weight: 700;
        }

        .fc-scrollgrid,
        .fc td,
        .fc th {
            border-color: #eef0f2 !important;
        }

        /* Event pill */
        .fc-event {
            border: none;
            border-radius: 6px;
            padding: 2px 6px;
            font-size: 0.78rem;
            line-height: 1.35;
            white-space: normal;
            background-color: #22c55e !important;
            border-color: #22c55e !important;
            color: #ffffff !important;
            cursor: pointer;
            box-shadow: none;
        }

        .fc-event:hover {
            filter: brightness(0.92);
        }

        .fc-event-title {
            font-weight: 600;
        }

        .fc-daygrid-event-dot {
            display: none;
        }

        .fc-daygrid-more-link {
            font-size: 0.75rem;
            font-weight: 600;
            color: #ef4444;
        }

        .fc-daygrid-day.fc-day-other .fc-daygrid-day-number {
            color: #d1d5db;
        }

        /* ===== Empty state ===== */
        #empty-state {
            display: none;
            text-align: center;
            margin: 16px 0 0;
            padding: 14px 16px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fef2f2;
            color: #b91c1c;
            font-size: 0.95rem;
            font-weight: 600;
        }

        /* ===== Simple modal for event detail ===== */
        #event-modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(17, 24, 39, 0.45);
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        #event-modal {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            width: 90%;
            max-width: 380px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        #event-modal h3 {
            margin: 0 0 8px;
            font-size: 1.1rem;
            color: #111827;
        }

        #event-modal p {
            margin: 4px 0;
            font-size: 0.88rem;
            color: #4b5563;
        }

        #event-modal p strong {
            color: #111827;
        }

        #event-modal-close {
            margin-top: 16px;
            padding: 8px 16px;
            background: #f3f4f6;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            width: 100%;
        }

        #event-modal-close:hover {
            background: #e5e7eb;
        }
    </style>
</head>
<body>

    <h2>Pencarian Agenda</h2>

    <div id="search-box">
        <input type="text" id="search" placeholder="Cari nama agenda...">
        <button id="search-btn">Cari</button>
    </div>
    <div id="search-notification" role="alert"></div>

    <div id="calendar-wrapper">
        <div id="loading-overlay">Memuat agenda...</div>
        <div id="calendar"></div>
        <div id="empty-state">Agenda tidak ditemukan.</div>
    </div>

    <!-- Modal detail event -->
    <div id="event-modal-backdrop">
        <div id="event-modal">
            <h3 id="modal-title"></h3>
            <p><strong>Mulai:</strong> <span id="modal-start"></span></p>
            <p id="modal-end-wrapper"><strong>Selesai:</strong> <span id="modal-end"></span></p>
            <p id="modal-desc-wrapper"><strong>Deskripsi:</strong> <span id="modal-desc"></span></p>
            <button id="event-modal-close">Tutup</button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var calendarEl = document.getElementById('calendar');
            var $loading = $('#loading-overlay');
            var $empty = $('#empty-state');
            var $notification = $('#search-notification');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                buttonText: {
                    today: 'Hari ini'
                },
                height: 'auto',
                dayMaxEvents: 2,
                eventDisplay: 'block',
                displayEventTime: false,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false,
                    hour12: false
                },
                events: [],
                eventClick: function (info) {
                    showEventModal(info.event);
                }
            });
            calendar.render();

            function showEventModal(event) {
                $('#modal-title').text(event.title);
                $('#modal-start').text(formatDate(event.start));

                if (event.end) {
                    $('#modal-end-wrapper').show();
                    $('#modal-end').text(formatDate(event.end));
                } else {
                    $('#modal-end-wrapper').hide();
                }

                var desc = event.extendedProps.description;
                if (desc) {
                    $('#modal-desc-wrapper').show();
                    $('#modal-desc').text(desc);
                } else {
                    $('#modal-desc-wrapper').hide();
                }

                $('#event-modal-backdrop').css('display', 'flex');
            }

            function formatDate(date) {
                if (!date) return '-';
                return date.toLocaleString('id-ID', {
                    dateStyle: 'full',
                    timeStyle: 'short'
                });
            }

            $('#event-modal-close, #event-modal-backdrop').on('click', function (e) {
                if (e.target.id === 'event-modal-close' || e.target.id === 'event-modal-backdrop') {
                    $('#event-modal-backdrop').hide();
                }
            });

            // Fungsi fetch data agenda dari server
            function fetchAgenda(keyword = '') {
                $loading.show();
                $empty.hide();

                $.ajax({
                    url: '/agenda',
                    method: 'GET',
                    data: { q: keyword },
                    success: function (response) {
                        if (response.code === 200) {
                            var hasKeyword = keyword.trim() !== '';
                            var agendas = response.data || [];

                            calendar.removeAllEvents();
                            calendar.addEventSource(agendas);

                            if (hasKeyword && agendas.length === 0) {
                                $empty.text('Agenda tidak ditemukan.');
                                $empty.show();
                            }
                        } else {
                            $notification.text('Gagal memuat agenda. Silakan coba lagi.').show();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Gagal memuat data agenda:', error);
                        $notification.text('Gagal memuat agenda. Silakan coba lagi.').show();
                    },
                    complete: function () {
                        $loading.hide();
                    }
                });
            }

            // Listener tombol pencarian
            function searchAgenda() {
                var keyword = $('#search').val();

                if (keyword.trim() === '') {
                    $notification.text('Silakan masukkan nama agenda yang ingin dicari.').show();
                    return;
                }

                $notification.hide();
                fetchAgenda(keyword);
            }

            $('#search-btn').click(function (e) {
                e.preventDefault();
                searchAgenda();
            });

            $('#search').on('input', function () {
                if ($(this).val().trim() === '') {
                    $notification.text('Silakan masukkan nama agenda yang ingin dicari.').show();
                    fetchAgenda('');
                } else {
                    $notification.hide();
                }
            });

            // Cari juga saat tekan Enter di input
            $('#search').on('keypress', function (e) {
                if (e.which === 13) {
                    e.preventDefault();
                    searchAgenda();
                }
            });

            // Load data awal
            fetchAgenda();
        });
    </script>

</body>
</html>