<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Send Message to Job Seeker') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('company.send_message_to_jobseeker') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="application_id" class="col-md-4 col-form-label text-md-right">{{ __('Application ID') }}</label>

                            <div class="col-md-6">
                                <input id="application_id" type="text" class="form-control @error('application_id') is-invalid @enderror" name="application_id" value="{{ old('application_id') }}" required autofocus>

                                @error('application_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                            <div class="col-md-6">
                                @if(empty($message))
                                    <textarea id="message" class="form-control" name="message" readonly>Job Seeker Not Applied for job</textarea>
                                @else
                                    <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" required>{{ old('message') }}</textarea>
                                @endif

                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Message') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
