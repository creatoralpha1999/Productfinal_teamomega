@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <!-- <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Gallery</h4>
            </div>
            <div class="row">

                @foreach($galleries as $gallery)
                    @if(Storage::disk('public')->exists('gallery/'.$gallery->image) && $gallery->image)
                        <div class="col s12 m4">
                            <div class="card">
                                <div class="card-image">
                                    <span class="card-image-bg materialboxed" style="background-image:url({{Storage::url('gallery/'.$gallery->image)}});"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>

            <div class="m-t-30 m-b-60 center">
                {{ $galleries->links() }}
            </div>

        </div>
    </section> -->
<!DOCTYPE html>
<html>
  <head>
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin=""
    />
    <script
      src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
      crossorigin=""
    ></script>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://fonts.googleapis.com/css?family=Raleway"
    rel="stylesheet"
  />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #f1f1f1;
    }

    #valueForm {
      background-color: #ffffff;
      margin: 100px auto;
      font-family: Raleway;
      padding: 40px;
      width: 70%;
      min-width: 300px;
    }

    h1 {
      text-align: center;
    }

    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }

    button {
      background-color: #4caf50;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 17px;
      font-family: Raleway;
      cursor: pointer;
    }

    button:hover {
      opacity: 0.8;
    }

    #prevBtn {
      background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }

    .step.active {
      opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #4caf50;
    }

    #mapid {
      height: 240px;
    }
  </style>
  <body>
    <form id="valueForm" action="/">
      <h1>Enter details about your property:</h1>
      <!-- One "tab" for each step in the form: -->
      <div class="tab">
        Full Address
        <p>
          <input
            placeholder="Unit no./Street Address, Suburb, City, State- Postcode"
            oninput="this.className = ''"
            name="fname"
          />
        </p>
      </div>
      <div class="tab">
        Property Details:
        <p>
          <input
            placeholder="Number of bedrooms..."
            oninput="this.className = ''"
            name="bedroom"
          />
        </p>
        <p>
          <input
            placeholder="Number of bathrooms..."
            oninput="this.className = ''"
            name="bathroom"
          />
        </p>
        <p>
          <input
            placeholder="Number of Car parking spaces..."
            oninput="this.className = ''"
            name="carpark"
          />
        </p>
      </div>
      <div class="tab">
        Property age and type:
        <p>
          <input
            placeholder="Year built..."
            oninput="this.className = ''"
            name="yyyy"
          />
        </p>
        <p>
          <input
            placeholder="Property type: Apartment/Unit/Townhouse/Grannyflat"
            oninput="this.className = ''"
            name="Type"
          />
        </p>
      </div>
      <div class="tab">
        Property Location Details:
        <p>
          <label for="zone">Choose a zone:</label>
          <select name="Property Zone" class="_zone" style="all: unset; border: 1px solid black;">
            <optgroup label="Property zone:">
              <option value="residential">Residential Zone</option>
              <option value="commercial">Commercial Zone</option>
              <option value="industrial">Industrial Zone</option>
              <option value="agricultural">Agricultural Zone</option>
              <option value="esthetic">Exthetic Zone</option>
              <option value="combination">Combination Zone</option>
            </optgroup>
          </select>
        </p>
        <p>
          <label for="zone">Choose council:</label>
          <select name="Property Zone" class="_zone" style="all: unset; border: 1px solid black;">
            <optgroup label="Council List for NSW:">
              <option value="bayside">Bayside Council</option>
              <option value="blacktowncity">Blacktown City Council</option>
              <option value="burwood">Burwood</option>
              <option value="camden">Camden City Council</option>
              <option value="campbelltown">Campbelltown Council</option>
              <option value="canadabay">Canada bay Council</option>
              <option value="canterbury-bankstown">
                Canterbury-Bankstown City Council
              </option>
              <option value="cumberlandcity">Cumberland City Council</option>
              <option value="fairfield">Fairfield City Council</option>
              <option value="Georgesriver">Georges River Council</option>
              <option value="hornsbyshire">Hornsby Shire Council</option>
              <option value="hunter'shill">Hunter's Hill Council</option>
              <option value="innerwest">Innerwest City Council</option>
              <option value="ku-ring-gai">Ku-ring-gai City Council</option>
              <option value="lanecove">lane Cove City Council</option>
              <option value="liverpool">Liverpool City Council</option>
              <option value="mosman">EMosman City Council</option>
              <option value="northsydney">North Sydney City Council</option>
              <option value="Northenbeaches">Northen Beaches Council</option>
              <option value="parramatta">Commercial Zone</option>
              <option value="penrith">Penrith City Council</option>
              <option value="Randwick">Randwick City Council</option>
              <option value="ryde">Ryde City Council</option>
              <option value="strathfield">Strathfield City Council</option>
              <option value="sutherland">Sutherland Council</option>
              <option value="sydney">Sydney Council</option>
              <option value="thehillsshire">The Hills Shire Council</option>
              <option value="waverley">Waverley City Council</option>
              <option value="willoughby">Willoughby City Council</option>
              <option value="Woollahra">Woollahra City Council</option>
            </optgroup>
          </select>
        </p>
      </div>
      <div class="tab">
        Please enter lot number for your property:

        <p>
          <input
            placeholder="Enter your Property Lot Number"
            oninput="this.className = ''"
            name="floorarea"
          />
        </p>
        <p>
          <label for="lotnumber">Don't have your property lot number?</label>
        </p>
        <p>Please visit the link below:</p>
        <a
          href="https://online.nswlrs.com.au/wps/portal/six/find-records/!ut/p/z1/04_Sj9CPykssy0xPLMnMz0vMAfIjo8ziLQMMLQydLIy8DAwtLAwcvQOdTIKM3AwNLMz0w8EKnN0dPUzMfQwMDEwsjAw8XZw8XMwtfQ0MPM30o4jRj0cBSL8BDuBoANQfBVaCzwWEzCjIDY0wyHRUBAAB9Ddm/dz/d5/L2dBISEvZ0FBIS9nQSEh/"
        >
          Find your Property Lot Number Here at NSW LRS Website</a
        >
      </div>
      <div class="tab">
        Property loacation on map:

        <div id="mapid"></div>
        <script>
          var mymap = L.map("mapid").setView([-33.8561, 151.2099], 13);
          L.tileLayer(
            "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
            {
              attribution:
                ' &copy; <a href="https://www.openstreetmap.org/"></a>  <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, © <a href="https://www.mapbox.com/">Mapbox</a>',
              maxZoom: 18,
              id: "mapbox/streets-v11",
              tileSize: 512,
              zoomOffset: -1,
              accessToken:
                "pk.eyJ1Ijoia2Fya2lzYWNoaW4xNTEiLCJhIjoiY2tkem1jbmZpMnk2ODJ5bXljZGt0YjlsZiJ9.fGBB5ivacjZY9KeyH8D8Zw",
            }
          ).addTo(mymap);
        </script>

        <p>
          <input type="radio" name="gender" value="yes" style="all: unset;" /> Yes, my property lies
          within the map.
        </p>
        <p>
          <input type="radio" name="gender" value="no" style="all: unset;" /> No, my property lies
          beyong the shown map.
        </p>
      </div>
      
      <div style="overflow: auto">
        <div style="float: right">
          <button type="button" id="prevBtn" onclick="nextPrev(-1)">
            Previous
          </button>
          <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
      </div>
      <!-- Circles which indicates the steps of the form: -->
      <div style="text-align: center; margin-top: 40px">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        
      </div>
    </form>

    <script>
      var currentTab = 0; // Current tab is set to be the first tab (0)
      showTab(currentTab); // Display the current tab

      function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
          document.getElementById("prevBtn").style.display = "none";
        } else {
          document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == x.length - 1) {
          document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
          document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n);
      }

      function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
          // ... the form gets submitted:
          document.getElementById("valueForm").submit();
          alert(
            "Your Request is submitted successfully, we will contact you shortly."
          );
          return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
      }

      function validateForm() {
        // This function deals with validation of the form fields
        var x,
          y,
          i,
          valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
          // If a field is empty...
          if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
          }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
          document.getElementsByClassName("step")[currentTab].className +=
            " finish";
        }
        return valid; // return the valid status
      }

      function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i,
          x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
          x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
      }
      var map = L.map("map").setView([0, 0], 1);

      L.tileLayer(
        "https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=KkGOVu5ttCLIhmkF19iK",
        {
          attribution:
            '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
        }
      ).addTo(map);
      var marker = L.marker([-33.856, 151.215]).addTo(map);
    </script>
  </body>
</html>


@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('.materialboxed').materialbox();
    });
</script>
@endsection