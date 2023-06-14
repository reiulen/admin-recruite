<div style="flex: 1 1 auto; flex-direction: column; gap: 20px; ">
    <div class="form-group row">
        <div class="col-lg-6">
            <div style="font-size: 16px; font-weight: 400">Full Name</div>
            <div style="font-size: 18px; padding-top: 4px; font-weight: 500">{{ $data->name ?? '-' }}</div>
        </div>
        <div class="col-lg-6">
            <div style="font-size: 16px; font-weight: 400">Email</div>
            <div style="font-size: 18px; padding-top: 4px; font-weight: 500">{{ $data->email ?? '-' }}</div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <div style="font-size: 16px; font-weight: 400">Phone</div>
            <div style="font-size: 18px; padding-top: 4px; font-weight: 500">{{ $data->phone ?? '-' }}</div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <div style="font-size: 16px; font-weight: 400">Address</div>
            <div style="font-size: 18px; padding-top: 4px; font-weight: 500">
                {{ $data->address }}
                Postcode {{ $data->poscode }},<br/>
                {{ $data->country }} <br/>
            </div>
        </div>
        <div class="col-lg-6">
            <div style="font-size: 16px; font-weight: 400">Detail Address</div>
            <div style="font-size: 18px; padding-top: 4px; font-weight: 500">
                {{ $data->detail_address ?? '-' }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <div style="font-size: 16px; font-weight: 400">Hear About Us</div>
            <div style="font-size: 18px; padding-top: 4px; font-weight: 500">
                {{ $data->hear_about_us ?? '-' }}
            </div>
        </div>
        <div class="col-lg-6">
            <div style="font-size: 16px; font-weight: 400">Additional Comments</div>
            <div style="font-size: 18px; padding-top: 4px; font-weight: 500">
                {{ $data->message ?? '-' }}
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center mt-4">
        @if ($data->extension_file == 'png' || $data->extension_file == 'jpg' || $data->extension_file == 'jpeg')
        <img style="width: 100%" src="{{ $data->document }}" alt="">
        @else
        <iframe style="min-height: 700px; width: 100%"  src="/pdf/web/viewer.html?file={{ asset($data->document) }}"></iframe>
        @endif
    </div>
</div>
