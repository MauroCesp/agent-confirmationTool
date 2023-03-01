<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
</head>
<body>


    <div class="wk-docs-research-example">
        <!-- Artificial wrapper for auto-hiding functionality, should be removed from final usage -->
        <header class="wk-banner wk-banner-extra-margins" role="banner">
            <div class="wk-banner-container">
                <a class="wk-logo-container" href="javascript:void(0)" title="Wolters Kluwer">
                    <img class="wk-logo wk-logo-medium" src="https://cdn.wolterskluwer.io/wk/fundamentals/2.x.x/logo/assets/large.svg" alt="Wolters Kluwer"/>
                    <img class="wk-logo wk-logo-small" src="https://cdn.wolterskluwer.io/wk/fundamentals/2.x.x/logo/assets/small.svg" alt="Wolters Kluwer"/>
                </a>
                <div class="wk-banner-content">
                    <div class="wk-banner-left-content">
                    </div>
                    <div class="wk-banner-right-content">
                        <div class="wk-banner-action-bar">
                            <a href="javascript:void(0)" class="wk-banner-action-bar-item wk-button wk-button-text wk-button-icon-left">
                                <span class="wk-icon-clock"></span>History</a>
                            <a href="javascript:void(0)" class="wk-banner-action-bar-item wk-button wk-button-text wk-button-icon-left">
                                <span class="wk-icon-star"></span>Favorites</a>
                            <a href="javascript:void(0)" class="wk-banner-action-bar-item wk-button wk-button-text wk-button-icon-left">
                                <span class="wk-icon-alarm-on"></span>Notifications</a>
                            <div class="wk-dropdown">
                                <button class="wk-button wk-button-icon wk-dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="wk-icon-filled-more" aria-hidden="true"></span>
                                    <span class="wk-sr-only">More</span>
                                </button>
                                <div class="wk-dropdown-menu">
                                    <div>
                                        <div class="wk-dropdown-close-area">
                                            <button type="button" class="wk-button wk-button-icon wk-button-close wk-dropdown-close">
                                                <span class="wk-icon-filled-close" aria-hidden="true" ></span>
                                                <span class="wk-sr-only">Close dropdown</span>
                                            </button>
                                        </div>
                                        <ul class="wk-dropdown-menu-list">
                                            <li>
                                                <a
                                                    href="javascript:void(0)"
                                                    class="wk-dropdown-item"
                                                >
                                                    <span
                                                        class="wk-icon-clock"
                                                        aria-hidden="true"
                                                    ></span
                                                    >History
                                                </a>
                                            </li>
                                            <li>
                                                <a
                                                    href="javascript:void(0)"
                                                    class="wk-dropdown-item"
                                                >
                                                    <span
                                                        class="wk-icon-star"
                                                        aria-hidden="true"
                                                    ></span
                                                    >Favorites
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>


    <div class="fluid-container">

        <div class="wk-page-container" style="padding-left: 0px!important;">
            <div class="wk-row">
                <div class="wk-col-6" style="padding-top: 80px;">
                    <h1 class="wk-display-3">Wolters Kluwer Resources</h1>
                    <p style="padding-top: 30px;">Trusted clinical technology and evidence-based solutions that drive effective decision-making and outcomes across healthcare.</p>
                </div>
                <div class="wk-col-6">
                    <img src="{{ asset('images/main_banner.png') }}"/>

                </div>
            </div>
        </div>

    </div>
        <div class="wk-page-container" style="padding-left: 0px!important;">

        <!-- ##################################### DYNAMIC BLOCKS START HERE  ############################################## -->

                @yield('content')

        <!-- ##################################### DYNAMIC BLOCKS END HERE  ############################################## -->


        </div>



    <!-- ##################################### DYNAMIC BLOCKS START HERE  ############################################## -->

          @include('layouts.footer')

    <!-- ##################################### DYNAMIC BLOCKS END HERE  ############################################## -->



<!-- polyfills for Chrome, FF, and Safari -->
<script src="https://unpkg.com/@webcomponents/custom-elements@^1.2.4/src/native-shim"></script>
<!-- for IE11 and Edge -->
<script src="https://unpkg.com/@webcomponents/custom-elements@^1.2.4"></script>
<!-- the rest is for IE11 -->
<script src="https://unpkg.com/polyfill-array-includes@^2.0.0/index.js"></script>
<script src="https://unpkg.com/es6-shim@^0.35.3"></script>


<script>
    if (!Element.prototype.matches) {
        Element.prototype.matches = Element.prototype.msMatchesSelector ||
            Element.prototype.webkitMatchesSelector;
    }

    if (!Element.prototype.closest) {
        Element.prototype.closest = function(s) {
            var el = this;
            if (!document.documentElement.contains(el)) { return null; }
            do {
                if (el.matches(s)) { return el; }
                el = el.parentElement || el.parentNode;
            } while (el !== null && el.nodeType === 1);
            return null;
        };
    }

    if (!Element.prototype.append) {
        Element.prototype.append = function() {
            var argArr = Array.prototype.slice.call(arguments),
                docFrag = document.createDocumentFragment();
            argArr.forEach(function(argItem) {
                var isNode = argItem instanceof Node;
                docFrag.appendChild(isNode ? argItem : document.createTextNode(String(argItem)));
            });
            this.appendChild(docFrag);
        }
    }
</script>

<!-- @wk/components JS -->
<script src="https://cdn.wolterskluwer.io/wk/components/2.x.x/bundle.js"></script>
</body>
</html>
