<x-auth-layout title="Dashboard">

    {{-- CDN Dependencies --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- style --}}
    <style>
        .loader {
            animation: rotate 1s infinite;
            height: 50px;
            width: 50px;
        }

        .loader:before,
        .loader:after {
            border-radius: 50%;
            content: "";
            display: block;
            height: 20px;
            width: 20px;
        }

        .loader:before {
            animation: ball1 1s infinite;
            background-color: #fff;
            box-shadow: 30px 0 0 #ff3d00;
            margin-bottom: 10px;
        }

        .loader:after {
            animation: ball2 1s infinite;
            background-color: #ff3d00;
            box-shadow: 30px 0 0 #fff;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg) scale(0.8)
            }

            50% {
                transform: rotate(360deg) scale(1.2)
            }

            100% {
                transform: rotate(720deg) scale(0.8)
            }
        }

        @keyframes ball1 {
            0% {
                box-shadow: 30px 0 0 #ff3d00;
            }

            50% {
                box-shadow: 0 0 0 #ff3d00;
                margin-bottom: 0;
                transform: translate(15px, 15px);
            }

            100% {
                box-shadow: 30px 0 0 #ff3d00;
                margin-bottom: 10px;
            }
        }

        @keyframes ball2 {
            0% {
                box-shadow: 30px 0 0 #fff;
            }

            50% {
                box-shadow: 0 0 0 #fff;
                margin-top: -20px;
                transform: translate(15px, 15px);
            }

            100% {
                box-shadow: 30px 0 0 #fff;
                margin-top: 0;
            }
        }

        /* Spinner Wrapper */
        #spinner-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        #spinner-wrapper.hidden {
            display: none;
        }
    </style>

    {{-- main --}}
    <main class="container-fluid mt-3 p-0">
        @if (auth()->user())
        <h3 class="m-0">DATA VISUALIZATIONS</h3>

        {{-- Filter Form --}}
        <div class="mb-2">
            <form action="" class="d-flex align-items-center gap-2" id="form-filter-chart-one">
                <select name="year_filter" id="year-filter" class="form-select">
                    @for ($i = Carbon\Carbon::now('Asia/Manila')->year; $i >= 1990 ; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-success text-nowrap">
                    <i class="bi bi-check-lg" style="font-style: normal;"> Filter</i>
                </button>
            </form>
        </div>

        {{-- Spinner Overlay --}}
        <div id="spinner-wrapper">
            <div class="loader"></div>
        </div>

        {{-- Chart Area --}}
        <div class="row">
            <div id="chart-1"></div>
        </div>
        @endif

        {{-- Summary Stats --}}
        <h3>SUMMARY STATISTICS</h3>
        <div class="row mb-3 mt-3">
            {{-- waiting --}}
            <div class="col-lg-3 col-md-4 col-sm-6 col-xsm-6">
                <div class="bg-white p-3 rounded shadow-lg h-100 d-flex flex-column justify-content-between">
                    <i class="text-primary bi bi-clock-history fs-5 d-block mb-3" style="font-style: normal;">
                        Waiting</i>
                    <h1 class="text-info m-0" id="waiting"></h1>
                </div>
            </div>
            @if (auth()->user())
            {{-- total count --}}
            <div class="col-lg-3 col-md-4 col-sm-6 col-xsm-6">
                <div class="bg-white p-3 rounded shadow-lg h-100 d-flex flex-column justify-content-between">
                    <i class="text-primary bi bi-clock-history fs-5 d-block   mb-3" style="font-style: normal;">
                        Total Parkings</i>
                    <h1 class="text-info m-0">
                        {{floor(App\Models\ParkingLog::getTotalLogCount() / 2)}}
                    </h1>
                </div>
            </div>

            {{-- total todays count --}}
            <div class="col-lg-3 col-md-4 col-sm-6 col-xsm-6">
                <div class="bg-white p-3 rounded shadow-lg h-100 d-flex flex-column justify-content-between">
                    <i class="text-primary bi bi-clock-history fs-5 d-block   mb-3" style="font-style: normal;">
                        Total Todays Parkings</i>
                    <h1 class="text-info m-0">
                        {{App\Models\ParkingLog::getTodaysTotalParking()}}
                    </h1>
                </div>
            </div>
            @endif
        </div>

        <section class="row" style="row-gap: 1em;" id="row-parking-slots-wrapper">
        </section>

        {{-- if admin --}}
        @if (auth()->user())
        <section class="container-fluid m-0 p-0 mt-4 shadow-lg">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="m-0 card-title text-white"> Queues</h5>
                </div>
                <div class="card-body">
                    {{-- form --}}
                    <form class="form" action="{{route('input-queue')}}" method="POST">
                        @csrf
                        <input type="number" name="queue" id="queue" class="form-control"
                            placeholder="Enter Waiting Number" required>
                        <div class="d-flex flex-droducted justify-content-end">
                            <button type="submit" class="btn btn-primary mt-4">
                                <i class="bi bi-box-arrow-right text-uppercase"
                                    style="font-style: normal; text-spacing: 0.1em;"> Submit</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        @endif
    </main>

    {{-- script --}}
    <script>
        let chartOneInstance = null;

        document.addEventListener('DOMContentLoaded', function () {
            getParkingSlots();
            setInterval(getParkingSlots, 1000);

            getQueue();
            setInterval(getQueue, 1000);

            renderChartOne();
            filterChartOne();
        });

        async function getParkingSlots() {
            try {
                const response = await fetch('/getParkingSlots', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error();

                const data = await response.json();
                const row = document.getElementById('row-parking-slots-wrapper');
                row.innerHTML = `<h3 class="m-0 text-primary">LIST OF PARKING SLOTS</h3>`;

                for (const element of data) {
                    const class_status = element.status === 'occupied' ? 'text-danger' : 'text-success';
                    row.innerHTML += `
                        <div class="col-lg-3 col-md-6 col-sm-4">
                            <div class="bg-white rounded shadow-lg p-3 d-flex flex-column h-100 border">
                                <span class="text-primary text-uppercase mb-3" style="font-size: 0.9rem;">Slot No. ${element.slot_no}</span>
                                <i class="bi bi-truck-front-fill ${class_status} fs-5" style="font-style: normal;"> ${element.status}</i>
                            </div>
                        </div>`;
                }
            } catch (error) {
                console.error(error.message);
                toastr.error("Something Went Wrong, Please Try Again!", "Error");
            }
        }

        async function getQueue() {
            try {
                const response = await fetch('/get-waiting-list');
                if (!response.ok) throw new Error();

                const data = await response.json();
                document.getElementById('waiting').innerHTML = data.queue;
            } catch (error) {
                console.error(error.message);
                toastr.error("Something Went Wrong, Please Try Again", "Error");
            }
        }

        async function renderChartOne() {
            const spinner = document.getElementById('spinner-wrapper');
            spinner.classList.remove('hidden');

            try {
                const chartOne = document.getElementById('chart-1');
                const year = document.getElementById('year-filter').value;

                const months = await getMonthsForChartOne(year);
                const slots = await Promise.all([
                    getMontDataPerSlots(1, year),
                    getMontDataPerSlots(2, year),
                    getMontDataPerSlots(3, year),
                    getMontDataPerSlots(4, year)
                ]);

                const series = slots.map((slotData, index) => ({
                    name: `Slot ${index + 1}`,
                    data: slotData.map(e => parseInt(e.total))
                }));

                const options = {
                    series: series,
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            borderRadius: 5,
                            borderRadiusApplication: 'end'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: months
                    },
                    yaxis: {
                        title: {
                            text: 'Parkings'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: val => `${val} Parkings`
                        }
                    }
                };

                if (chartOneInstance) {
                    chartOneInstance.destroy();
                }

                chartOneInstance = new ApexCharts(chartOne, options);
                await chartOneInstance.render();

            } catch (error) {
                console.error(error.message);
                toastr.error("Something Went Wrong. Please Try Again", "Error");
            } finally {
                spinner.classList.add('hidden');
            }
        }

        const getMonthsForChartOne = async (year) => {
            const response = await fetch(`/get-months-for-chart-one/${year}`, {
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });
            if (!response.ok) throw new Error();
            return await response.json();
        }

        const getMontDataPerSlots = async (slot, year) => {
            const response = await fetch(`/get-data-per-slot-per-month/${slot}/${year}`, {
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });
            if (!response.ok) throw new Error();
            return await response.json();
        }

        function filterChartOne() {
            document.getElementById('form-filter-chart-one').onsubmit = async (e) => {
                e.preventDefault();
                await renderChartOne();
            };
        }
    </script>

</x-auth-layout>