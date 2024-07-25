@extends('cashier.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pending Transaction</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Plat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Item</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending_transaction as $pending)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">{{ $pending->plate_number }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">{{ $pending->item_name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">{{ $pending->harga }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="border-0 bg-transparent text-secondary font-weight-bold text-xs px-2" data-bs-toggle="modal" data-bs-target="#modal-notification-{{ $pending->id }}">
                                            <svg width="32" height="32" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M37.125 8.25H30.9375V6.1875C30.9375 4.91115 30.4305 3.68707 29.528 2.78455C28.6254 1.88203 27.4014 1.375 26.125 1.375H17.875C16.5986 1.375 15.3746 1.88203 14.472 2.78455C13.5695 3.68707 13.0625 4.91115 13.0625 6.1875V8.25H6.875C6.32799 8.25 5.80339 8.4673 5.41659 8.85409C5.0298 9.24089 4.8125 9.76549 4.8125 10.3125C4.8125 10.8595 5.0298 11.3841 5.41659 11.7709C5.80339 12.1577 6.32799 12.375 6.875 12.375H7.5625V35.75C7.5625 36.6617 7.92466 37.536 8.56932 38.1807C9.21398 38.8253 10.0883 39.1875 11 39.1875H33C33.9117 39.1875 34.786 38.8253 35.4307 38.1807C36.0753 37.536 36.4375 36.6617 36.4375 35.75V12.375H37.125C37.672 12.375 38.1966 12.1577 38.5834 11.7709C38.9702 11.3841 39.1875 10.8595 39.1875 10.3125C39.1875 9.76549 38.9702 9.24089 38.5834 8.85409C38.1966 8.4673 37.672 8.25 37.125 8.25ZM17.1875 6.1875C17.1875 6.00516 17.2599 5.8303 17.3889 5.70136C17.5178 5.57243 17.6927 5.5 17.875 5.5H26.125C26.3073 5.5 26.4822 5.57243 26.6111 5.70136C26.7401 5.8303 26.8125 6.00516 26.8125 6.1875V8.25H17.1875V6.1875ZM32.3125 35.0625H11.6875V12.375H32.3125V35.0625ZM19.9375 17.875V28.875C19.9375 29.422 19.7202 29.9466 19.3334 30.3334C18.9466 30.7202 18.422 30.9375 17.875 30.9375C17.328 30.9375 16.8034 30.7202 16.4166 30.3334C16.0298 29.9466 15.8125 29.422 15.8125 28.875V17.875C15.8125 17.328 16.0298 16.8034 16.4166 16.4166C16.8034 16.0298 17.328 15.8125 17.875 15.8125C18.422 15.8125 18.9466 16.0298 19.3334 16.4166C19.7202 16.8034 19.9375 17.328 19.9375 17.875ZM28.1875 17.875V28.875C28.1875 29.422 27.9702 29.9466 27.5834 30.3334C27.1966 30.7202 26.672 30.9375 26.125 30.9375C25.578 30.9375 25.0534 30.7202 24.6666 30.3334C24.2798 29.9466 24.0625 29.422 24.0625 28.875V17.875C24.0625 17.328 24.2798 16.8034 24.6666 16.4166C25.0534 16.0298 25.578 15.8125 26.125 15.8125C26.672 15.8125 27.1966 16.0298 27.5834 16.4166C27.9702 16.8034 28.1875 17.328 28.1875 17.875Z" fill="#F24E1E"/>
                                            </svg>
                                        </button>
                                        <div class="modal fade" id="modal-notification-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="py-3 text-center">
                                                            <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_56_4)">
                                                                    <path d="M17.4998 2.91663C25.5542 2.91663 32.0832 9.44558 32.0832 17.5C32.0832 25.5543 25.5542 32.0833 17.4998 32.0833C9.44546 32.0833 2.9165 25.5543 2.9165 17.5C2.9165 9.44558 9.44546 2.91663 17.4998 2.91663ZM17.4998 5.83329C14.4056 5.83329 11.4382 7.06246 9.25026 9.25038C7.06233 11.4383 5.83317 14.4058 5.83317 17.5C5.83317 20.5942 7.06233 23.5616 9.25026 25.7495C11.4382 27.9375 14.4056 29.1666 17.4998 29.1666C20.594 29.1666 23.5615 27.9375 25.7494 25.7495C27.9373 23.5616 29.1665 20.5942 29.1665 17.5C29.1665 14.4058 27.9373 11.4383 25.7494 9.25038C23.5615 7.06246 20.594 5.83329 17.4998 5.83329ZM17.4998 21.875C17.8866 21.875 18.2575 22.0286 18.531 22.3021C18.8045 22.5756 18.9582 22.9465 18.9582 23.3333C18.9582 23.7201 18.8045 24.091 18.531 24.3645C18.2575 24.638 17.8866 24.7916 17.4998 24.7916C17.1131 24.7916 16.7421 24.638 16.4686 24.3645C16.1951 24.091 16.0415 23.7201 16.0415 23.3333C16.0415 22.9465 16.1951 22.5756 16.4686 22.3021C16.7421 22.0286 17.1131 21.875 17.4998 21.875ZM17.4998 8.74996C17.8866 8.74996 18.2575 8.9036 18.531 9.1771C18.8045 9.45059 18.9582 9.82152 18.9582 10.2083V18.9583C18.9582 19.3451 18.8045 19.716 18.531 19.9895C18.2575 20.263 17.8866 20.4166 17.4998 20.4166C17.1131 20.4166 16.7421 20.263 16.4686 19.9895C16.1951 19.716 16.0415 19.3451 16.0415 18.9583V10.2083C16.0415 9.82152 16.1951 9.45059 16.4686 9.1771C16.7421 8.9036 17.1131 8.74996 17.4998 8.74996Z" fill="#C40C0C"/>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_56_4">
                                                                        <rect width="35" height="35" fill="white"/>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                            <h4 class="text-gradient text-danger mt-4">Are you sure?</h4>
                                                            <p>This item will be deleted permanently</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('items.destroy', $item->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-white">Ok, Got it</button>
                                                        </form>
                                                        <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
