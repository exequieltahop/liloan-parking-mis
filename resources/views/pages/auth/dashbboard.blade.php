<x-auth-layout title="Dashboard" title="Dashbboard">
    <main class="container-fluid mt-3">
        <section class="row" style="row-gap: 1em;" id="row-parking-slots-wrapper">
        </section>

        {{-- if admin --}}
        @if (auth()->user())
        <section class="container-fluid m-0 p-0 mt-4 shadow-lg">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0 card-title"> Quequeing</h5>
                </div>
                <div class="card-body">
                    {{-- form --}}
                    <form class="form">
                        <input type="number" name="queque" id="queque" class="form-control" required>
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
            }, 2000);
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
    </script>
</x-auth-layout>