<x-auth-layout title="Dashboard">
    <main class="container-fluid mt-3">
        <section class="row" style="row-gap: 1em;">
            <h3 class="m-0">LIST OF PARKING SLOTS</h3>
            <div class="col-md-3">
                <div class="bg-danger rounded shadow-lg p-3 d-flex flex-column h-100">
                    <span class="text-white text-uppercase">Slot No. 1</span>
                    <i class="bi bi-truck-front-fill text-white fw-bold fs-3" style="font-style: normal;"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-success rounded shadow-lg p-3 d-flex flex-column h-100">
                    <span class="text-white text-uppercase">Slot No. 2</span>
                    <i class="bi bi-truck-front-fill text-white fw-bold fs-3" style="font-style: normal;"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-danger rounded shadow-lg p-3 d-flex flex-column h-100">
                    <span class="text-white text-uppercase">Slot No. 3</span>
                    <i class="bi bi-truck-front-fill text-white fw-bold fs-3" style="font-style: normal;"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="bg-success rounded shadow-lg p-3 d-flex flex-column h-100">
                    <span class="text-white text-uppercase">Slot No. 4</span>
                    <i class="bi bi-truck-front-fill text-white fw-bold fs-3" style="font-style: normal;"></i>
                </div>
            </div>
        </section>

        {{-- if admin --}}
        {{-- @if (auth()->user()) --}}
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
                                    <i class="bi bi-box-arrow-right text-uppercase" style="font-style: normal; text-spacing: 0.1em;"> Submit</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        {{-- @endif --}}
    </main>
</x-auth-layout>