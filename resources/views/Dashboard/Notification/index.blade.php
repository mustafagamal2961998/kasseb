<x-Dashboard.Layout.Layout title=" جميع اﻹشعارات">
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/notification/notification.css') }}">
    @endpush
    <div class="container pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <a href="{{ route('dashboard.notifications.create') }}">
                    <button class="btn bg-gradient-primary mb-0 toast-btn" type="button" data-target="infoToast">
                        <span class="material-icons">
                            notifications
                        </span>
                        إرسال اشعار جديد
                    </button>
                </a>
            </div>
        </div>


        <div class="row">

            <div class="col-lg-12 col-md-8 col-12 mx-auto">
                <div class="card my-4">

                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                                    إرسال اشعارات
                                </h4>

                            </div>
                        </div>

                        <div class="card-body w-70 m-auto">
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr class="text-center">
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    <span class="material-icons align-middle">
                                                        image
                                                    </span>
                                                    صورة اﻹشعار
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    <span class="material-icons align-middle">
                                                        draw
                                                    </span>
                                                    نص اﻹشعار
                                                </th>

                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    <span class="material-icons align-middle">
                                                        tune
                                                    </span>
                                                    تحكم
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($notifications as $notification)
                                                <tr class="text-center">
                                                    <td>
                                                        <div>
                                                            <img src="{{ $notification->getFirstMediaUrl('notification') }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $notification->message }}
                                                        </p>
                                                    </td>

                                                    <td>
                                                        <form
                                                            action="{{ route('dashboard.notifications.destroy', $notification->id) }}"
                                                            method="POST" class="px-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-primary">
                                                                <span class="material-icons">
                                                                    delete
                                                                </span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="6">
                                                        لا يوجد بيانات حتي الان
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{$notifications->links()}}

                        </div>



                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('script')
        <script src="{{ asset('assets/js/dashboard/notification/notification.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/jquery/notification/notification.js') }}"></script>
    @endpush
</x-Dashboard.Layout.Layout>
