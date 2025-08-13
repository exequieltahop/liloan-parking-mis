<x-auth-layout title="Logs">
    {{-- tailwind css --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    <style>
        .pagination .page-item.active .page-link {
            background-color: #000029 !important; /* your desired color, e.g., green */
            border-color: #000029 !important;
            color: white !important; /* text color */
        }
        .page-link{
            color: #000029 !important;
        }
    </style>


    <div class="card bg-white mt-4 shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title m-0">Parking Logs</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th class="bg-primary text-white">Slot No</th>
                        <th class="bg-primary text-white">Type</th>
                        <th class="bg-primary text-white">Date</th>
                    </thead>
                    <tbody>
                        @foreach ($logs as $item)
                            <tr>
                                <td>{{$item->slot_no}}</td>
                                <td>{{$item->type}}</td>
                                <td style="width: fit-content;">{{$item->created_at->format('F j, Y h:i:s a')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="overflow-auto">
                @if ($logs->hasPages())
                    <nav>
                        <ul class="pagination justify-content-center">

                            {{-- Previous Page Link --}}
                            @if ($logs->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo; Prev</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $logs->previousPageUrl() }}" rel="prev">&laquo; Prev</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($logs->links()->elements as $element)
                                {{-- Dots --}}
                                @if (is_string($element))
                                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                                @endif

                                {{-- Array of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $logs->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($logs->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $logs->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next &raquo;</span>
                                </li>
                            @endif

                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
</x-auth-layout>