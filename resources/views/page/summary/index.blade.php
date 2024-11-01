@extends('dashboard.index')

@section('title', 'Summary')
@section('page', 'Summary')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')

<div class="container">

    <form id="filter-form">
      <div class="btn-group">
        <input type="text" id="date-range" name="date_range" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" />
        <button class="btn btn-primary" type="submit">Filter</button>
      </div>
        <button class="btn btn-black" id="export-btn">Export to Excel</button>
    </form>

    <div class="card mt-4">
        <div class="card-body">
            <div class="row ">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                  <div class="card">
                    <div class="card-body p-3">
                      <div class="row">
                        <div class="col-8">
                          <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Penjualan Harian</p>
                            <h5 class="font-weight-bolder mb-0">
                                <span id="daily-sales"></span>
                            </h5>
                          </div>
                        </div>
                        <div class="col-4 text-end d-flex justify-content-end">
                          <div class="icon icon-shape bg-black shadow text-center border-radius-md d-flex d-flex align-items-center justify-content-center">
                            <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.785 9.10551H3.21623C2.88098 9.10625 2.5502 9.18619 2.24852 9.33937C1.94684 9.49255 1.68201 9.71504 1.47376 9.99027C1.2669 10.2652 1.12232 10.5857 1.05094 10.9276C0.979562 11.2696 0.983239 11.6241 1.0617 11.9643L2.83822 19.5847C3.09497 20.5667 3.65353 21.4327 4.42745 22.0486C5.20163 22.6658 6.14949 23 7.12459 23H15.8744C16.8495 23 17.7974 22.6658 18.5715 22.0486C19.3455 21.4327 19.904 20.5667 20.1608 19.5847L21.9373 11.9655C22.0569 11.4518 22.0044 10.9107 21.7887 10.4328C21.5729 9.95477 21.207 9.56892 20.7522 9.33978C20.45 9.18619 20.1186 9.10611 19.7828 9.10551M7.05875 13.7362V18.3681M11.5006 13.7362V18.3681M15.9425 13.7362V18.3681M19.2742 9.10551C19.2738 8.04006 19.0724 6.98518 18.6817 6.00151C18.2909 5.01784 17.7184 4.12477 16.9971 3.37362C15.5364 1.85249 13.5602 0.999095 11.5006 1C9.44103 0.999095 7.46487 1.85249 6.00419 3.37362C5.28309 4.12487 4.71081 5.01798 4.32022 6.00165C3.92963 6.98531 3.72843 8.04014 3.72819 9.10551" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                  <div class="card">
                    <div class="card-body p-3">
                      <div class="row">
                        <div class="col-8">
                          <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Penjualan Bulanan</p>
                            <h5 class="font-weight-bolder mb-0">
                                <span id="monthly-sales"></span>
                            </h5>
                          </div>
                        </div>
                        <div class="col-4 text-end d-flex justify-content-end">
                          <div class="icon icon-shape bg-black shadow text-center border-radius-md d-flex justify-content-center align-items-center">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.20903 10.324H2.40103C1.82203 10.324 1.35303 10.794 1.35303 11.372V18.202C1.35303 18.78 1.82303 19.25 2.40103 19.25H4.21003C4.79003 19.25 5.25903 18.78 5.25903 18.201V11.372C5.25876 11.0939 5.14816 10.8272 4.95149 10.6305C4.75482 10.4339 4.48816 10.3233 4.21003 10.323M10.904 0.75H9.09603C8.51603 0.75 8.04703 1.22 8.04703 1.799V18.2C8.04703 18.78 8.51703 19.249 9.09703 19.249H10.904C11.484 19.249 11.953 18.779 11.953 18.2V1.8C11.953 1.22 11.483 0.751 10.903 0.751M17.599 5.927H15.79C15.21 5.927 14.741 6.397 14.741 6.977V18.2C14.741 18.78 15.211 19.249 15.79 19.249H17.598C17.8762 19.2487 18.1428 19.1381 18.3395 18.9415C18.5362 18.7448 18.6468 18.4781 18.647 18.2V6.976C18.647 6.396 18.177 5.927 17.597 5.927" stroke="#F8F8F8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <p class="text-sm mb-0 text-capitalize font-weight-bold">Penjualan Tahunan</p>
                              <h5 class="font-weight-bolder mb-0">
                                <span id="yearly-sales"></span>
                              </h5>
                            </div>
                          </div>
                          <div class="col-4 text-end d-flex justify-content-end">
                            <div class="icon icon-shape bg-black shadow text-center border-radius-md d-flex justify-content-center align-items-center">
                              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M4.20903 10.324H2.40103C1.82203 10.324 1.35303 10.794 1.35303 11.372V18.202C1.35303 18.78 1.82303 19.25 2.40103 19.25H4.21003C4.79003 19.25 5.25903 18.78 5.25903 18.201V11.372C5.25876 11.0939 5.14816 10.8272 4.95149 10.6305C4.75482 10.4339 4.48816 10.3233 4.21003 10.323M10.904 0.75H9.09603C8.51603 0.75 8.04703 1.22 8.04703 1.799V18.2C8.04703 18.78 8.51703 19.249 9.09703 19.249H10.904C11.484 19.249 11.953 18.779 11.953 18.2V1.8C11.953 1.22 11.483 0.751 10.903 0.751M17.599 5.927H15.79C15.21 5.927 14.741 6.397 14.741 6.977V18.2C14.741 18.78 15.211 19.249 15.79 19.249H17.598C17.8762 19.2487 18.1428 19.1381 18.3395 18.9415C18.5362 18.7448 18.6468 18.4781 18.647 18.2V6.976C18.647 6.396 18.177 5.927 17.597 5.927" stroke="#F8F8F8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                  </svg>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="card">
                                <div class="card-body p-3">
                                  <div class="row">
                                    <div class="col-8">
                                      <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Omset Penjualan</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <span id="monthly-omset"></span>
                                        </h5>
                                      </div>
                                    </div>
                                    <div class="col-4 text-end d-flex justify-content-end">
                                      <div class="icon icon-shape bg-black shadow text-center border-radius-md d-flex d-flex align-items-center justify-content-center">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.5 6.5C4.5 5.96957 4.71071 5.46086 5.08579 5.08579C5.46086 4.71071 5.96957 4.5 6.5 4.5H17.929C17.995 4.5 18.029 4.5 18.056 4.503C18.1684 4.51587 18.2732 4.5665 18.3531 4.6466C18.433 4.72671 18.4834 4.83155 18.496 4.944C18.5 4.98621 18.5014 5.02862 18.5 5.071C18.5 5.469 18.5 5.668 18.481 5.836C18.4049 6.51127 18.1017 7.14069 17.6212 7.62121C17.1407 8.10172 16.5113 8.40486 15.836 8.481C15.668 8.5 15.469 8.5 15.071 8.5H15M4.5 6.5C4.5 7.03043 4.71071 7.53914 5.08579 7.91421C5.46086 8.28929 5.96957 8.5 6.5 8.5H17.5C18.443 8.5 18.914 8.5 19.207 8.793C19.5 9.086 19.5 9.557 19.5 10.5V12.5M4.5 6.5V15.5C4.5 17.386 4.5 18.328 5.086 18.914C5.672 19.5 6.614 19.5 8.5 19.5H17.5C18.443 19.5 18.914 19.5 19.207 19.207C19.5 18.914 19.5 18.443 19.5 17.5V16.5M19.5 12.5H17.5C16.557 12.5 16.086 12.5 15.793 12.793C15.5 13.086 15.5 13.557 15.5 14.5C15.5 15.443 15.5 15.914 15.793 16.207C16.086 16.5 16.557 16.5 17.5 16.5H19.5M19.5 12.5V16.5" stroke="white"/>
                                            </svg>


                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="card">
                                <div class="card-body p-3">
                                  <div class="row">
                                    <div class="col-8">
                                      <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengeluaran</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <span id="monthly-expend"></span>
                                        </h5>
                                      </div>
                                    </div>
                                    <div class="col-4 text-end d-flex justify-content-end">
                                      <div class="icon icon-shape bg-black shadow text-center border-radius-md d-flex d-flex align-items-center justify-content-center">
                                        <svg width="28" height="28" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 3.50001C1.86739 3.50001 1.74021 3.55268 1.64645 3.64645C1.55268 3.74022 1.5 3.8674 1.5 4.00001C1.5 4.13261 1.55268 4.25979 1.64645 4.35356C1.74021 4.44733 1.86739 4.50001 2 4.50001H3.11L4.422 9.75001C4.5335 10.195 4.932 10.5 5.3905 10.5H11.6255C12.077 10.5 12.4605 10.2 12.579 9.76501L13.875 5.00001H12.828L11.625 9.50001H5.39L4.0785 4.25001C4.02432 4.03462 3.89944 3.84364 3.72384 3.70766C3.54824 3.57168 3.33209 3.49856 3.11 3.50001H2ZM11 10.5C10.1775 10.5 9.5 11.1775 9.5 12C9.5 12.8225 10.1775 13.5 11 13.5C11.8225 13.5 12.5 12.8225 12.5 12C12.5 11.1775 11.8225 10.5 11 10.5ZM6.5 10.5C5.6775 10.5 5 11.1775 5 12C5 12.8225 5.6775 13.5 6.5 13.5C7.3225 13.5 8 12.8225 8 12C8 11.1775 7.3225 10.5 6.5 10.5ZM8 3.50001V6.00001H6.5L8.5 8.00001L10.5 6.00001H9V3.50001H8ZM6.5 11.5C6.782 11.5 7 11.718 7 12C7 12.282 6.782 12.5 6.5 12.5C6.218 12.5 6 12.282 6 12C6 11.718 6.218 11.5 6.5 11.5ZM11 11.5C11.282 11.5 11.5 11.718 11.5 12C11.5 12.282 11.282 12.5 11 12.5C10.718 12.5 10.5 12.282 10.5 12C10.5 11.718 10.718 11.5 11 11.5Z" fill="white"/>
                                            </svg>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-7">
                      <div class="card z-index-2">
                        <div class="card-header pb-0">
                          <h6>Data Penjualan</h6>
                        </div>
                        <div class="card-body p-3">
                          <div class="chart">
                            <canvas id="salesChart" class="chart-canvas" height="300px"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(function() {
        $('#date-range').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            startDate: moment().startOf('month'),
            endDate: moment().endOf('month')
        });

        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            fetchSalesData();
        });

        $('#export-btn').on('click', function(e) {
            e.preventDefault();
            exportToExcel();
        });

        let salesChartInstance = null;

function fetchSalesData() {
    const dateRange = $('#date-range').val();
    const [startDate, endDate] = dateRange.split(' - ');

    fetch('{{ route("dashboard.fetchData") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            start_date: startDate,
            end_date: endDate
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Data received from server:', data);

        // Cek apakah data dailySales sesuai
        console.log('Daily Sales:', data.dailySales);  // Tambahkan ini untuk memeriksa apakah data diterima dengan benar

        const dailySalesTotal = Array.isArray(data.dailySales) ? data.dailySales.reduce((a, b) => a + b, 0) : data.dailySales;
        const monthlySalesTotal = Array.isArray(data.monthlySales) ? data.monthlySales.reduce((a, b) => a + b, 0) : data.monthlySales;
        const yearlySalesTotal = Array.isArray(data.yearlySales) ? data.yearlySales.reduce((a, b) => a + b, 0) : data.yearlySales;
        const monthlyOmsetTotal = Array.isArray(data.monthlyOmset) ? data.monthlyOmset.reduce((a, b) => a + b, 0) : data.monthlyOmset;
        const monthlyExpendTotal = Array.isArray(data.monthlyExpend) ? data.monthlyExpend.reduce((a, b) => a +  b, 0) : data.monthlyExpend;

        console.log('omset:', monthlyOmsetTotal);
        console.log('expends:', monthlyExpendTotal);  // Tambahkan ini untuk memeriksa apakah data diterima dengan benar

        document.getElementById('daily-sales').textContent = dailySalesTotal;
        document.getElementById('monthly-sales').textContent = monthlySalesTotal;
        document.getElementById('yearly-sales').textContent = yearlySalesTotal;
        document.getElementById('monthly-omset').textContent = formatRupiah(monthlyOmsetTotal);
        document.getElementById('monthly-expend').textContent  = formatRupiah(monthlyExpendTotal);

        const labels = generateDateRange(startDate, endDate);

        // Gunakan tanggal dari labels untuk mengambil data penjualan dari dailySales
        const salesData = labels.map(date => {
            return data.chartSalesData[date] || 0;  // Jika tidak ada data untuk tanggal tertentu, gunakan 0
        });

        console.log('Mapped Sales Data:', salesData);  // Jika data tidak ada, gunakan 0 sebagai default

        console.log('Data received from server:', data.dailySales);  // Log untuk melihat data yang diterima dari server
        console.log('Labels:', labels); // Debugging: Log salesData yang dihasilkan

        displayChart(labels, salesData);
    })
    .catch(error => {
        console.error('Error fetching sales data:', error);
    });
}

function generateDateRange(startDate, endDate) {
    const start = moment(startDate);
    const end = moment(endDate);
    const dateArray = [];

    while (start <= end) {
        dateArray.push(start.format('YYYY-MM-DD'));  // Format harus sama dengan format kunci dailySales
        start.add(1, 'days');
    }

    return dateArray;
}

function formatRupiah(amount) {
    if (!amount) return '';

    // Round the amount to remove any decimals
    amount = Math.round(amount);

    // Convert to string and format as Rupiah
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function displayChart(labels, salesData) {
    const ctx = document.getElementById("salesChart").getContext("2d");

    // Definisikan gradient untuk bar dan line chart
    var gradientStroke1 = ctx.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

    var gradientStroke2 = ctx.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)');

    // Jika chart sudah ada, hancurkan terlebih dahulu
    if (salesChartInstance !== null) {
        salesChartInstance.destroy();
    }

    // Format label menjadi 'Juli 09'
    const formattedLabels = labels.map(date => moment(date).format('MMM DD', 'id'));
    console.log('Formatted Labels:', formattedLabels);  // Debugging: Log formattedLabels

    // Buat chart baru
    salesChartInstance = new Chart(ctx, {
        type: "line",
        data: {
            labels: formattedLabels,  // Gunakan formattedLabels yang berisi tanggal dalam format yang diinginkan
            datasets: [{
                label: "Sales Quantity",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#cb0c9f",
                borderWidth: 3,
                backgroundColor: gradientStroke1,
                fill: true,
                data: salesData,  // Gunakan salesData yang sudah disesuaikan dengan labels
                maxBarThickness: 6
            },
            {
                type: "line",
                label: "Trend",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#3A416F",
                borderWidth: 3,
                backgroundColor: gradientStroke2,
                fill: true,
                data: salesData,
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            aspectRatio: 2,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
}

        function exportToExcel() {
            const dateRange = $('#date-range').val();
            const [startDate, endDate] = dateRange.split(' - ');

            fetch('{{ route("dashboard.exportExcel") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    start_date: startDate,
                    end_date: endDate
                })
            })
            .then(response => response.blob())
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'sales_data.xlsx';
                document.body.appendChild(a);
                a.click();
                a.remove();
            });
        }

        // Load initial data
        fetchSalesData();
    });
</script>

@endsection

@endsection
