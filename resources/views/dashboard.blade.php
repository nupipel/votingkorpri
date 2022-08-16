@extends('layout.master')

@push('plugin-styles')
    <!-- Plugin css import here -->
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Total Member</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $data['members'] }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            {{-- <span>+3.3%</span> --}}
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Voting Count</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $data['counts'] }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            {{-- <span>-2.8%</span> --}}
                                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Belum Voting</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $data['uncount'] }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            {{-- <span>+2.8%</span> --}}
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Pie chart</h6>
                    <canvas id="chartjsPie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Bubble chart</h6>
                    <canvas id="chartjsBubble"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        $(() => {



            var colors = {
                primary: "#6571ff",
                secondary: "#7987a1",
                success: "#05a34a",
                info: "#66d1d1",
                warning: "#fbbc06",
                danger: "#ff3366",
                light: "#e9ecef",
                dark: "#060c17",
                muted: "#7987a1",
                gridBorder: "rgba(77, 138, 240, .15)",
                bodyColor: "#000",
                cardBg: "#fff"
            }

            var fontFamily = "'Roboto', Helvetica, sans-serif";
            var datas = {{ $candidates }};

            if ($('#chartjsPie').length) {
                new Chart($('#chartjsPie'), {
                    type: 'pie',
                    data: {
                        labels: ["Africa", "Asia", "Europe"],
                        datasets: [{
                            label: "Population (millions)",
                            backgroundColor: [colors.primary, colors.danger, colors.info],
                            borderColor: colors.cardBg,
                            data: [2478, 4267, 1334]
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: true,
                                labels: {
                                    color: colors.bodyColor,
                                    font: {
                                        size: '13px',
                                        family: fontFamily
                                    }
                                }
                            },
                        },
                        aspectRatio: 2,
                    }
                });
            }
        });
    </script>
@endpush
