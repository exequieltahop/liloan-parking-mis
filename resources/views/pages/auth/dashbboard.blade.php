<x-auth-layout title="Dashboard" title="Dashboard">

    {{-- bs cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> {{-- apex charts cdn --}}

    <main class="container-fluid mt-3 p-0">
        @if (auth()->user())
            <h3 class="m-0">DATA VISUALIZATIONS</h3>
            <div class="mb-2">
                {{-- filter year --}}
                <form action="" class="d-flex align-items-center gap-2">
                    {{-- select year --}}
                    <select name="year_filter" id="year-filter" class="form-select">
                        @for ($i = Carbon\Carbon::now('Asia/Manila')->year; $i >= 1990 ; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>

                    {{-- btn --}}
                    <button type="submit" class="btn btn-success text-nowrap">
                        <i class="bi bi-check-lg" style="font-style: normal;"> Filter</i>
                    </button>
                </form>
            </div>

            {{-- chart 1 --}}
            <div class="row">
                <div class="" id="chart-1"></div>
            </div>
        @endif

        <h3>SUMMARY STATISTICS</h3>
        <div class="row mb-3 mt-3">
            {{-- waiting --}}
            <div class="col-lg-3 col-md-4 col-sm-6 col-xsm-6">
                <div class="bg-white p-3 rounded shadow-lg h-100 d-flex flex-column justify-content-between">
                    <i class="text-primary bi bi-clock-history fs-5 d-block   mb-3" style="font-style: normal;">
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

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // init parking slots
            getParkingSlots();
            setInterval(() => {
                getParkingSlots();
            }, 1000);

            // get queue
            getQueue();
            setInterval(() => {
                getQueue();
            }, 1000);

            // render chart 1
            renderChartOne();
            setTimeout(() => {
                renderChartOne();
            }, 5000);
        });

        // get parking slots
        async function getParkingSlots(){
            try {
                const url = `/getParkingSlots`;
                const response = await fetch(url, {
                    method : 'GET',
                    headers : {
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if(!response.ok){
                    throw new Error("");
                }else{
                    const data = await response.json();

                    const row = document.getElementById('row-parking-slots-wrapper');
                    row.innerHTML = ``;
                    row.innerHTML += `<h3 class="m-0 text-primary">LIST OF PARKING SLOTS</h3>`;

                    for (const element of data) {

                        const class_status = element.status == 'occupied' ? 'text-danger' : 'text-success';

                        row.innerHTML += `<div class="col-lg-3 col-md-6 col-sm-4">
                                            <div class="bg-white rounded shadow-lg p-3 d-flex flex-column h-100 border">
                                                <span class="text-primary text-uppercase mb-3" style="font-size: 0.9rem;">Slot No. ${element.slot_no}</span>
                                                <i class="bi bi-truck-front-fill ${class_status} fs-5" style="font-style: normal;">
                                                ${element.status}
                                                </i>
                                            </div>
                                        </div>`;
                    }
                }
            } catch (error) {
                console.error(error.message);
                toastr.error("Something Went Wrong, Pls Try Again!", "Error");
            }
        }

        // get queue
        async function getQueue() {
            try {
                const url = `/get-waiting-list`;
                const response = await fetch(url);

                if(!response.ok){
                    throw new Error("");
                }else{
                    const data = await response.json();
                    const waiting = document.getElementById('waiting');

                    waiting.innerHTML = ``;
                    waiting.innerHTML += `${data.queue}`;
                }
            } catch (error) {
                console.error(error.message);
                toastr.error("Something Went Wrong, Pls Try Again, Thank You", "Error");
            }
        }

        // render chart
        async function renderChartOne(){
            try {
                const chartOne = document.getElementById('chart-1');
                const year = document.getElementById('year-filter').value;

                const months = await getMonthsForChartOne(year);

                const slot1_data = [44, 44, 44, 44, 44];
                const slot2_data = [44, 44, 44, 44, 44];
                const slot3_data = [44, 44, 44, 44, 44];
                const slot4_data = [44, 44, 44, 44, 44];

                var options = {
                    series: [
                        {
                            name: 'Slot 1',
                            data: slot1_data
                        }, {
                            name: 'Slot 2',
                            data: slot2_data
                        }, {
                            name: 'Slot 3',
                            data: slot3_data
                        },
                        {
                            name: 'Slot 4',
                            data: slot4_data
                        }
                    ],
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
                        },
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
                        categories: months,
                    },
                    yaxis: {
                        title: {
                            text: 'Parkings'
                        }
                    },
                    fill: {
                        city: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                            return "$ " + val + " thousands"
                            }
                        }
                    }
                };

                var chart = new ApexCharts(chartOne, options);
                chart.render();
            } catch (error) {
                toastr.error("Something Went Wrong Pls Try Again", "Error");
                console.error(error.message);

            }

        }

        // get months for chart 1
        const getMonthsForChartOne = async (year) => {
            try {
                const url = `/get-months-for-chart-one/${year}`;

                const respons = await fetch(url, {
                    method : 'GET',
                    headers : {
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if(!respons.ok){
                    throw new Error("");
                }else{
                    const data = await respons.json();

                    return data;
                }
            } catch (error) {
                throw error;
            }
        }

        const getMontDataPerSlots = async (slot) => {
            try {
                const response = await fetch(url, {
                    method : 'GET',
                    headers : {
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if(!response.ok){
                    throw new Error("");
                }else{
                    return ;
                }
            } catch (error) {
                throw error;
            }
        }
    </script>
</x-auth-layout>