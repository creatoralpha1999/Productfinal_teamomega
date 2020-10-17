@extends('frontend.layouts.app')

@section('styles')
@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m3">
                    <div class="agent-sidebar">
                        @include('user.sidebar')
                    </div>
                </div>

                <div class="col s12 m9">

                    <h4 class="agent-title">DASHBOARD</h4>
                    
                    <div class="agent-content">

                        <div class="row">
                            <div class="col s12">
                                <div class="box indigo white-text p-30">
                                    <i class="material-icons left">comment</i>
                                    <span class="truncate uppercase bold font-18">Comments</span>
                                    <h4 class="m-t-10 m-b-0">{{ $commentcount }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <div class="box indigo white-text p-20">
                                    <i class="material-icons left font-18">comment</i>
                                    <span class="truncate uppercase bold">Recent Comments</span>
                                </div>
                                <div class="box-content">
                                    @foreach($comments as $key => $comment)
                                        <div class="grey lighten-4">
                                            <span class="border-bottom display-block p-15  grey-text-d-2">
                                                {{ ++$key }}. {{ $comment->body }}
                                                
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    {{ $comments->links() }}
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col s12">
                                <div class="box indigo white-text p-20">
                                    <i class="material-icons left font-18">notifications</i>
                                    <span class="truncate uppercase bold">Issue Property Leaving Notice</span>
                                </div>
                                <div class="box-content">
                                    @foreach($comments as $key => $comment)
                                        <div class="grey lighten-4">
                                            <span class="border-bottom display-block p-15  grey-text-d-2">
                                                {{ ++$key }}. {{ $comment->body }}
                                                
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    {{ $comments->links() }}
                                </div>
                            </div>
                        </div>

                        <div>
            <div class="box indigo white-text p-20 m-t-30">
              <span class="truncate uppercase bold center"
                >Complaint Ledger</span
              >
            </div>

            <div class="m-t-30">
              <label class="label-custom" for="location_longitude"
                >Complaint Description</label
              >
              <input
                id="complaint_description"
                name="complaint_description"
                type="text"
                class="validate"
              />
            </div>

            <div class="col m-t-30">
              <label class="label-custom" for="type">Complaint Status</label>

              <label>
                <input
                  class="with-gap"
                  name="type"
                  value="house"
                  type="radio"
                />
                <span>Pending</span>
              </label>

              <label>
                <input
                  class="with-gap"
                  name="type"
                  value="apartment"
                  type="radio"
                />
                <span>Resolved</span>
              </label>
            </div>

            <div class="row m-t-30">
              <div class="file-field input-field col s12">
                <div class="btn indigo">
                  <span>Image Before</span>
                  <input id="__image-before" type="file" name="image" />
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" />
                </div>
              </div>

              <div class="file-field input-field col s12">
                <div class="btn indigo">
                  <span>Image After</span>
                  <input id="__image-after" type="file" name="image" />
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" />
                </div>
              </div>

              <div class="row">
                <div class="col s12 m-t-30">
                  <button
                    class="btn waves-effect waves-light btn-block btn-large indigo darken-4"
                    type="submit"
                    onclick="__handleSubmit()"
                  >
                    Submit
                    <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>

              <script>
                function __handleSubmit() {
                  function getBase64(file) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                      console.log(reader.result);
                    };
                    reader.onerror = function (error) {
                      console.log("Error: ", error);
                    };
                  }

                  var file1 = getBase64(
                    document.querySelector("#image-before").files[0]
                  );
                  var file2 = getBase64(
                    document.querySelector("#image-after").files[0]
                  );
                  console.log(file1, file2);
                }
              </script>
            </div>

                    </div>
        
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection