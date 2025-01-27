<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
              <img src="{{ asset('assets/img/elegance.png') }}" style="border-radius: 50%;" />
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2" style="font-size: 1.2rem;text-transform: capitalize;">{{ auth()->guard('candidate')->user()->name }}</span><br>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="{{ route('candidate.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
           
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Customer">Pofile</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('candidates.password.change') }}" class="menu-link">
                    <div data-i18n="Add Customer">Change Password</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Customer">Permutation</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('candidate.questions') }}" class="menu-link">
                    <div data-i18n="Add Customer">Questions</div>
                  </a>
                </li>
              </ul>
              
            </li>
            

           

           

           
            
           
            
          </ul>
        </aside>