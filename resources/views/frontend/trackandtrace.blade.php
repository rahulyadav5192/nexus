  <section>
      <div class="container mt-5">
          <h2 class="head-2 head-underline mb-4">Track & <span class="text-secondary">Trace</span>
              <span class="custom-underline"></span>
          </h2>
          <p>Enter your tracking number to get real-time updates on your shipment status and location</p>

          <div class="tracking-container">
              <!-- Dropdown -->
              <select class="tracking-select">
                  <option selected disabled>Service Type</option>
                  <option value="Bill of Lading">Bill of Lading</option>
                  <option value="Air Way Bill">Air Way Bill</option>
                  <option value="Container Number">Container Number</option>
                  <option value="Booking Ref">Booking Ref</option>
                  <option value="Purchase Order">Purchase Order</option>
              </select>

              <!-- Textbox -->
              <input type="text" class="tracking-input" placeholder="Enter your tracking number">

              <button class="tracking-btn">
                  <span class="btn-text">Track Now</span>
                  <span class="btn-arrow">➤</span>
                  <span class="btn-loader" style="display:none;"></span>
              </button>

          </div>

          <!-- Results -->
          <div id="tracking-result"></div>
          <div id="tracking-error" class="tracking-error"></div>


          <div class="row mt-5">
              <div class="col-md-6 col-12">
                  <h2 class="head-2 mb-4 text-secondary">We Provide a Full Range of Innovative And Reliable Supply
                      Chain Solutions
                  </h2>
                  <p style="font-weight: 800;">We are committed to delivering innovative, reliable and most effective
                      supply chain solutions.
                      Empower our clients to expand their reach and business growth. Therefore, exceeding customer
                      expectations by providing seamless shipping solutions with our strong ​global network and local
                      expertise.</p>


              </div>
              <div class="col-md-6 col-12">
                  <img src="assets/img/home/map.png" alt="About Us" class="img-fluid rounded d-none d-md-block">
              </div>
          </div>
          <div>
              <ul class="home-list list-unstyled mb-0 row g-4">
                  <li class="col-md-6 px-4">
                      <div class="logo">
                          <img src="assets/icons/truck.svg" alt="Truck Icon" />
                      </div>

                      <div>
                          <span class="head">On Time Delivery</span>
                          <p>We are committed to delivering your cargo promptly and reliably,
                              ensuring it reaches its destination exactly when you need it.</p>
                      </div>
                  </li>
                  <li class="col-md-6 px-4">
                      <div class="logo">
                          <img src="assets/icons/globe.svg" alt="Globe Icon" />
                      </div>

                      <div>
                          <span class="head">Worldwide Service</span>
                          <p>Logistics specializes in import, export, re-export, cross trade
                              or LCL to any destination globally.</p>
                      </div>
                  </li>
                  <li class="col-md-6 px-4">
                      <div class="logo">
                          <img src="assets/icons/telephone.svg" alt="Telephone Icon" />
                      </div>

                      <div>
                          <span class="head">24/7 Customer Support</span>
                          <p>Our dedicated support team is available around the clock to assist you
                              with any inquiries or issues. Experience seamless support whenever you
                              need it.</p>
                      </div>
                  </li>
                  <li class="col-md-6 px-4">
                      <div class="logo">
                          <img src="assets/icons/handshake.svg" alt="Handshake Icon" />
                      </div>

                      <div>
                          <span class="head">Global Network</span>
                          <p>Strong partnership with international carriers,agents,and logistics
                              providers across key trade lanes.</p>
                      </div>
                  </li>

              </ul>
             <div class="justify-content-center d-flex">
                  <a href="{{ route('services') }}" class="btn btn-primary mt-4">READ MORE</a>
             </div>

          </div>

      </div>

  </section>