<x-Dashboard.Layout.Layout title="إرسال اشعارات">
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/notification/notification.css') }}">
    @endpush
    <div class="container pt-5 pb-5">

        <div class="header-route-btn-container pb-2 px-3">
            <div class="header-route-btn-container">
                <a href="{{ route('dashboard.notifications.index') }}">
                    <button class="btn bg-gradient-primary mb-0 toast-btn" type="button" data-target="infoToast">
                        <span class="material-icons">
                            dashboard
                        </span>
                        كل الاشعارات
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
                            <form role="form" action="{{ route('dashboard.notifications.store') }}" method="POST"
                                class="text-start" enctype="multipart/form-data">
                                @csrf

                                <div class="input-group input-group-outline my-3">
                                    <label for="message">
                                        رسالة الاشعار
                                    </label>
                                    <textarea name="message" id="message" class="form-control" placeholder="رسالة الاشعار">{{ old('message') }}</textarea>
                                </div>

                                @error('message')
                                    <div class="alert alert-primary alert-dismissible text-white" role="alert">
                                        <span class="text-sm">
                                            {{ $message }}
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                    </div>
                                @enderror

                                <div class="input-group input-group-outline my-3">
                                    <label for="image" class="logo-images-label">
                                        <p class="w-100 text-end">صورة الاشعار</p>
                                        <div>
                                            <div id="imagePreview">
                                                <img class="logo-image-preview"
                                                    src="{{ asset('assets/media/dashboard/external/img/form-file-input.svg') }}"
                                                    alt="image">
                                            </div>

                                        </div>

                                    </label>
                                    <input type="file" name="image" id="image" class="d-none" multiple>
                                </div>

                                @error('image')
                                    <div class="alert alert-primary alert-dismissible text-white" role="alert">
                                        <span class="text-sm">
                                            {{ $message }}
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                    </div>
                                @enderror

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mb-0 toast-btn">
                                        إرسال
                                    </button>
                                </div>

                            </form>



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
