<style>.main-navigation-ul>li.menu-item>a.menu-item-link{padding-left:12px !important; padding-right:12px !important;}a.goog-te-menu-value:hover {color: #000 !important;}</style>
<header data-height="74" data-sticky-height="55" data-responsive-height="90" data-transparent-skin="" data-header-style="1" data-sticky-style="fixed" data-sticky-offset="25%" id="mk-header-1" class="mk-header header-style-1 header-align-left  toolbar-true menu-hover-3 sticky-style-fixed mk-background-stretch boxed-header " role="banner" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
<div class="mk-header-holder">
   <div class="mk-header-toolbar">
      <div class="mk-grid header-grid">
         <div class="mk-toolbar-holder">
            <nav class="mk-toolbar-navigation">
               <ul id="menu-top-menu" class="menu">

<?php
if(!$this->session->userdata('user_id'))
{
?>          
<li id="menu-item-209" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo base_url(); ?>login"><span class="meni-item-text">SIGN IN</span></a></li>

<li id="menu-item-209" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?php echo base_url(); ?>register"><span class="meni-item-text">REGISTER</span></a></li>
<?php } else {?>

 <div class="dropdown" onclick="myFunction();">
  <button  class="dropbtn">
  <?php
  $user_image = getUserImage();
  if(!empty($user_image))
  {
  ?>
  <img src="<?php echo base_url(); ?>uploads/user_images/<?php echo $user_image; ?>">
  <?php
   }
   else
   {
   ?>
   <img src="<?php echo base_url(); ?>img/user.png">
   <?php   
   }
  ?>

   <span class="admin-drop"><?php echo ucfirst($this->session->userdata('user_name')); ?> <span class="angle"><i class="fa fa-angle-down"></i></span> </span></button>
  <div id="myDropdown" class="dropdown-content">
    <a href="<?php echo base_url(); ?>user/profile"><i class="fa fa-user"></i>My Profile </a>
  
    <a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out"></i>Logout</a>
  </div>
</div>

<?php } ?>
   <script type="text/javascript">
  /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {

    document.getElementById("myDropdown").classList.toggle("show");

}
 
// // Close the dropdown menu if the user clicks outside of it
// window.onclick = function(event) {
//   if (!event.target.matches('.dropbtn')) {

//     var dropdowns = document.getElementsByClassName("dropdown-content");
//     var i;
//     for (i = 0; i < dropdowns.length; i++) {
//       var openDropdown = dropdowns[i];
//       if (openDropdown.classList.contains('show')) {
//         openDropdown.classList.remove('show');
//       }
//     }
//   }
// }
</script> 




                  <li style="position:relative;" class="menu-item menu-item-gtranslate">
                     
                     <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,ja,ko,ru,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<style>
div#google_translate_element img {
    display: none;
}

.skiptranslate iframe {
    display: none;
}
</style>


                     <!--<select onchange="doGTranslate(this);" class="notranslate" id="gtranslate_selector">
                        <option value="" selected="selected">Select Language</option>
                        <option value="en|zh-CN">Chinese (Simplified)</option>
                        <option value="en|en">English</option>
                        <option value="en|ja">Japanese</option>
                        <option value="en|ko">Korean</option>
                        <option value="en|ru">Russian</option>
                        <option value="en|es">Spanish</option>
                     </select>-->
                     <style type="text/css">
                        #goog-gt-tt {display:none !important;}
                        .goog-te-banner-frame {display:none !important;}
                        .goog-te-menu-value:hover {text-decoration:none !important;}
                        .goog-text-highlight {background-color:transparent !important;box-shadow:none !important;}
                        body {top:0 !important;}
                        #google_translate_element2 {display:none!important;}
                     </style>
                     <div id="google_translate_element2">
                        <div class="skiptranslate goog-te-gadget" dir="ltr" style="">
                           <div id=":0.targetLanguage">
                              <select class="goog-te-combo">
                                 <option value="" selected="selected">Select Language</option>
                                 <option value="af">Afrikaans</option>
                                 <option value="sq">Albanian</option>
                                 <option value="am">Amharic</option>
                                 <option value="ar">Arabic</option>
                                 <option value="hy">Armenian</option>
                                 <option value="az">Azerbaijani</option>
                                 <option value="eu">Basque</option>
                                 <option value="be">Belarusian</option>
                                 <option value="bn">Bengali</option>
                                 <option value="bs">Bosnian</option>
                                 <option value="bg">Bulgarian</option>
                                 <option value="ca">Catalan</option>
                                 <option value="ceb">Cebuano</option>
                                 <option value="ny">Chichewa</option>
                                 <option value="zh-CN">Chinese (Simplified)</option>
                                 <option value="zh-TW">Chinese (Traditional)</option>
                                 <option value="co">Corsican</option>
                                 <option value="hr">Croatian</option>
                                 <option value="cs">Czech</option>
                                 <option value="da">Danish</option>
                                 <option value="nl">Dutch</option>
                                 <option value="eo">Esperanto</option>
                                 <option value="et">Estonian</option>
                                 <option value="tl">Filipino</option>
                                 <option value="fi">Finnish</option>
                                 <option value="fr">French</option>
                                 <option value="fy">Frisian</option>
                                 <option value="gl">Galician</option>
                                 <option value="ka">Georgian</option>
                                 <option value="de">German</option>
                                 <option value="el">Greek</option>
                                 <option value="gu">Gujarati</option>
                                 <option value="ht">Haitian Creole</option>
                                 <option value="ha">Hausa</option>
                                 <option value="haw">Hawaiian</option>
                                 <option value="iw">Hebrew</option>
                                 <option value="hi">Hindi</option>
                                 <option value="hmn">Hmong</option>
                                 <option value="hu">Hungarian</option>
                                 <option value="is">Icelandic</option>
                                 <option value="ig">Igbo</option>
                                 <option value="id">Indonesian</option>
                                 <option value="ga">Irish</option>
                                 <option value="it">Italian</option>
                                 <option value="ja">Japanese</option>
                                 <option value="jw">Javanese</option>
                                 <option value="kn">Kannada</option>
                                 <option value="kk">Kazakh</option>
                                 <option value="km">Khmer</option>
                                 <option value="ko">Korean</option>
                                 <option value="ku">Kurdish (Kurmanji)</option>
                                 <option value="ky">Kyrgyz</option>
                                 <option value="lo">Lao</option>
                                 <option value="la">Latin</option>
                                 <option value="lv">Latvian</option>
                                 <option value="lt">Lithuanian</option>
                                 <option value="lb">Luxembourgish</option>
                                 <option value="mk">Macedonian</option>
                                 <option value="mg">Malagasy</option>
                                 <option value="ms">Malay</option>
                                 <option value="ml">Malayalam</option>
                                 <option value="mt">Maltese</option>
                                 <option value="mi">Maori</option>
                                 <option value="mr">Marathi</option>
                                 <option value="mn">Mongolian</option>
                                 <option value="my">Myanmar (Burmese)</option>
                                 <option value="ne">Nepali</option>
                                 <option value="no">Norwegian</option>
                                 <option value="ps">Pashto</option>
                                 <option value="fa">Persian</option>
                                 <option value="pl">Polish</option>
                                 <option value="pt">Portuguese</option>
                                 <option value="pa">Punjabi</option>
                                 <option value="ro">Romanian</option>
                                 <option value="ru">Russian</option>
                                 <option value="sm">Samoan</option>
                                 <option value="gd">Scots Gaelic</option>
                                 <option value="sr">Serbian</option>
                                 <option value="st">Sesotho</option>
                                 <option value="sn">Shona</option>
                                 <option value="sd">Sindhi</option>
                                 <option value="si">Sinhala</option>
                                 <option value="sk">Slovak</option>
                                 <option value="sl">Slovenian</option>
                                 <option value="so">Somali</option>
                                 <option value="es">Spanish</option>
                                 <option value="su">Sundanese</option>
                                 <option value="sw">Swahili</option>
                                 <option value="sv">Swedish</option>
                                 <option value="tg">Tajik</option>
                                 <option value="ta">Tamil</option>
                                 <option value="te">Telugu</option>
                                 <option value="th">Thai</option>
                                 <option value="tr">Turkish</option>
                                 <option value="uk">Ukrainian</option>
                                 <option value="ur">Urdu</option>
                                 <option value="uz">Uzbek</option>
                                 <option value="vi">Vietnamese</option>
                                 <option value="cy">Welsh</option>
                                 <option value="xh">Xhosa</option>
                                 <option value="yi">Yiddish</option>
                                 <option value="yo">Yoruba</option>
                                 <option value="zu">Zulu</option>
                              </select>
                           </div>
                           Powered by <span style="white-space:nowrap"><a class="goog-logo-link" href="https://translate.google.com/" target="_blank"><img src="<?php echo base_url(); ?>img/googlelogo_color_42x16dp.png" style="padding-right: 3px" alt="Google Translate" width="37px" height="14px">Translate</a></span>
                        </div>
                     </div>
                  </li>



               </ul>
            </nav>
         </div>
      </div>
   </div>
   <div class="mk-header-inner add-header-height">
      <div class="mk-header-bg "></div>
      <div class="mk-toolbar-resposnive-icon">
         <svg class="mk-svg-icon" data-name="mk-icon-chevron-down" data-cacheid="icon-5aa0c7077c3f6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792">
            <path d="M1683 808l-742 741q-19 19-45 19t-45-19l-742-741q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"></path>
         </svg>
      </div>
      <div class="mk-grid header-grid">
         <div class="mk-header-nav-container one-row-style menu-hover-style-3" role="navigation" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
            <nav class="mk-main-navigation js-main-nav">
               <ul id="menu-main-menu" class="main-navigation-ul dropdownJavascript">
                  <li id="menu-item-33" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home page_item page-item-7 current_page_item has-mega-menu<?php echo ($this->uri->segment(1) == '') ? ' current-menu-item' : ''; ?>"><a class="menu-item-link js-smooth-scroll" href="<?php echo base_url(); ?>">HOME</a></li>
                  <li id="menu-item-311" class="menu-item menu-item-type-custom menu-item-object-custom no-mega-menu"><a class="menu-item-link js-smooth-scroll" href="#ROADMAP">ROAD MAP</a></li>
                  <li id="menu-item-371" class="menu-item menu-item-type-custom menu-item-object-custom no-mega-menu"><a class="menu-item-link js-smooth-scroll" href="#MEMBERSHIPKILLER">MEMBERSHIP KILLER WHALE</a></li>
                  <li id="menu-item-327" class="menu-item menu-item-type-custom menu-item-object-custom no-mega-menu<?php echo ($this->uri->segment(1) == 'team') ? ' current-menu-item' : ''; ?>"><a class="menu-item-link js-smooth-scroll" href="#OURTEAM">OUR TEAM</a></li>
                  <li id="menu-item-210" class="menu-item menu-item-type-post_type menu-item-object-page no-mega-menu"><a class="menu-item-link js-smooth-scroll" href="<?php echo base_url('whitepaper.pdf'); ?>" target="_blank">WHITEPAPER</a></li>
                  <li id="menu-item-437" class="menu-item menu-item-type-post_type menu-item-object-page no-mega-menu"><a class="menu-item-link js-smooth-scroll" href="<?php echo base_url(); ?>killer_token_sale">KILLER WHALE TOKEN SALE</a></li>
                  <li id="menu-item-409" class="menu-item menu-item-type-custom menu-item-object-custom no-mega-menu"><a class="menu-item-link js-smooth-scroll" href="#FAQ">FAQ</a></li>
               </ul>
            </nav>
         </div>
         <div class="mk-nav-responsive-link">
            <div class="mk-css-icon-menu">
               <div class="mk-css-icon-menu-line-1"></div>
               <div class="mk-css-icon-menu-line-2"></div>
               <div class="mk-css-icon-menu-line-3"></div>
            </div>
         </div>
         <div class=" header-logo fit-logo-img add-header-height logo-is-responsive logo-has-sticky">
            <a href="<?php echo base_url(); ?>" title="KILLER WHALE Token">
            <img class="mk-desktop-logo dark-logo " title="KILLER WHALE TOKEN" alt="KILLER WHALE TOKEN" src="<?php echo base_url(); ?>img/header-logo.png">
            <img class="mk-desktop-logo light-logo " title="KILLER WHALE TOKEN" alt="KILLER WHALE TOKEN" src="<?php echo base_url(); ?>img/header-logo.png">
            <img class="mk-resposnive-logo " title="KILLER WHALE TOKEN" alt="KILLER WHALE TOKEN" src="<?php echo base_url(); ?>img/header-logo.png">
            <img class="mk-sticky-logo " title="KILLER WHALE TOKEN" alt="KILLER WHALE TOKEN" src="<?php echo base_url(); ?>img/header-logo.png">
            </a>
         </div>
      </div>
      <div class="mk-header-right">
      </div>
   </div>
   <div class="mk-responsive-wrap">
      <nav class="menu-main-menu-container">
         <ul id="menu-main-menu-1" class="mk-responsive-nav">
            <li id="responsive-menu-item-33" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-7 current_page_item"><a class="menu-item-link js-smooth-scroll" href="<?php echo base_url(); ?>">HOME</a></li>
            <li id="responsive-menu-item-311" class="menu-item menu-item-type-custom menu-item-object-custom"><a class="menu-item-link js-smooth-scroll" href="#ROADMAP">ROAD MAP</a></li>
            <li id="responsive-menu-item-371" class="menu-item menu-item-type-custom menu-item-object-custom"><a class="menu-item-link js-smooth-scroll" href="#MEMBERSHIPKILLER">MEMBERSHIPKILLER</a></li>
            <li id="responsive-menu-item-327" class="menu-item menu-item-type-custom menu-item-object-custom"><a class="menu-item-link js-smooth-scroll" href="#OURTEAM">OUR TEAM</a></li>
            <li id="responsive-menu-item-210" class="menu-item menu-item-type-post_type menu-item-object-page"><a class="menu-item-link js-smooth-scroll" href="#">WHITEPAPER</a></li>
            <li id="responsive-menu-item-437" class="menu-item menu-item-type-post_type menu-item-object-page"><a class="menu-item-link js-smooth-scroll" href="<?php echo base_url(); ?>killer_token_sale">KILLER WHALE TOKEN SALE</a></li>
            <li id="responsive-menu-item-409" class="menu-item menu-item-type-custom menu-item-object-custom"><a class="menu-item-link js-smooth-scroll" href="#FAQ">FAQ</a></li>
         </ul>
      </nav>
      <form class="responsive-searchform" method="get" action="#">
         <input class="text-input" name="s" id="s" placeholder="Search.." type="text">
         <i>
            <input value="" type="submit">
            <svg class="mk-svg-icon" data-name="mk-icon-search" data-cacheid="icon-5aa0c7078112d" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1664 1792">
               <path d="M1152 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"></path>
            </svg>
         </i>
      </form>
   </div>
</div>
<div class="mk-header-padding-wrapper"></div>
</header>