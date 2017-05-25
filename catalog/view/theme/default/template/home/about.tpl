<?php echo $self->load->controller('home/page/header'); ?> 
   <div class="cf content">
   <div class="col-md-3 left-menu two-column-left">
      <div class="moduletable">
         <div class="moduletable">
            <ul class="menu">
               <li class=""><a href="about-us?title=senior-leadership-team"><span>Leadership Team</span></a></li>
               <li class=""><a href="about-us?title=our-history"><span>Our History</span></a></li>
               <li class=""><a href="about-us?title=socially-responsible-investing-policy"><span>Socially Responsible Investing Policy</span></a></li>
               <li class=""><a href="about-us?title=in-the-community"><span>In the Community</span></a></li>
               <li class=""><a href="about-us?title=contact-us-about-us"><span>Contact Us</span></a></li>
            </ul>
         </div>
      </div>
   </div>
   <div id="print-region" class="col-md-9 two-column-right">
      <?php if (!isset($_GET['title'])) { $_GET['title'] = ""; ?>
      <div class="blog_aboutus">
         <div class="category-desc">
            <h1>ABOUT MACKAY SHIELDS</h1>
            <div class="cf about-us">
               <div class="about-us-left">
                  <p>Building on our mission of managing income-oriented strategies designed to help our clients’ better meet their investment objectives, MacKay Shields has established a reputation over 40 years as a trusted and respected investment manager.</p>
                  <p>Today we offer a broad range of fixed income related strategies and solutions for a wide array of global clients including pension funds, government and financial institutions, family offices, high net worth individuals, endowments and foundations, and retail clients. Our investment strategies embrace extensive credit research conducted by investment teams comprised of over 50 investment professionals.</p>
               </div>
               <div class="about-us-right quote">
                  <div class="jcepopup-div" style="float:left; width:100%;"><a href="https://www.mackayshields.com/learn-more-about-mackay-shields" style="" class="jcepopup" rel="" onclick="recordVideoAccess('https://www.mackayshields.com/learn-more-about-mackay-shields', 'https://www.mackayshields.com/about-us', '/images/learn-about-mackay-video-img.png');">
                     <img class="jcepopup-img" height="150" width="100%" border="0" src="catalog/view/theme/default/home/images/learn-about-mackay-video-img.png">
                     </a>
                  </div>
               </div>
            </div>
            <div class="clr"></div>
         </div>
         <div class="cf items-row cols-1 row-0">
            <div class="cf item column-1">
               <div class="cf">
                  <div style="width: 634px;" class="left">
                     <h3 style="text-align:center">Total Assets under management: $95 billion</h3>
                  </div>
               </div>
               <div class="article-content cf">
                  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                  <script type="text/javascript">   
                     google.load('visualization', '1', {packages:['corechart']});
                     //google.setOnLoadCallback(setTimeout(function() { drawAssetsByClientTypeChart(); }, 10));
                     google.setOnLoadCallback(drawAssetsByClientTypeChart);
                     function drawAssetsByClientTypeChart() {
                     var data = google.visualization.arrayToDataTable([
                      ['Name', 'Value'],['Sub-advisory Funds: 47%', 47],['Public Funds: 17%', 17],['Taft-Hartley: 7%', 7],['Non-Profit & Other: 4%', 4],['Corporates: 13%', 13],['Insurance: 12%', 12],
                     ]);
                     var options = {
                      colors: ['#4C89A5', '#2F635C', '#6E6E6E', '#73988D', '#003A63', '#7B833C'],
                      chartArea: { width: '100%', height: '75%' },
                      fontSize: '12',
                      fontName: 'Arial Narrow',
                      pieSliceText: 'none',
                      pieStartAngle: 100,
                      tooltip: {text: 'percentage'},
                      legend: {position: 'right', textStyle: {fontSize: '12', bold: true}},
                     };
                     
                     var chart = new google.visualization.PieChart(document.getElementById('assets_by_client_type'));
                     
                     google.visualization.events.addListener(chart, 'onmouseover', function(e) {
                     // Hide the 2nd row of the tooltip
                     jQuery('#assets_by_client_type svg > g:last-child > g > g:last-child').css('display', 'none');
                     });
                     
                     chart.draw(data, options);
                     }
                  </script><script src="https://www.google.com/uds/?file=visualization&amp;v=1&amp;packages=corechart" type="text/javascript"></script>
                  <link href="https://www.google.com/uds/api/visualization/1.0/84dc8f392c72d48b78b72f8a2e79c1a1/ui+vi.css" type="text/css" rel="stylesheet">
                  <script src="https://www.google.com/uds/api/visualization/1.0/84dc8f392c72d48b78b72f8a2e79c1a1/format+vi,default+vi,ui+vi,corechart+vi.I.js" type="text/javascript"></script>    
                  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                  <script type="text/javascript">
                     google.load('visualization', '1', {packages:['corechart']});
                     google.setOnLoadCallback(drawAssetsByClientDomicileChart);
                     function drawAssetsByClientDomicileChart() {
                     var data = google.visualization.arrayToDataTable([
                      ['Name', 'Value'],['North America: 76%', 76],['Europe: 17%', 17],['Asia: 7%', 7],
                     ]);
                     
                     var options = {
                      colors: ['#4C89A5', '#7B833C', '#6E6E6E'],
                      chartArea: { width: '100%', height: '75%' },
                      fontSize: '12',
                      fontName: 'Arial Narrow',
                      pieSliceText: 'none',
                      pieStartAngle: 0,
                      tooltip: {text: 'percentage'},
                      legend: {position: 'right', textStyle: {fontSize: '12', bold: true}},
                     };
                     
                     var chart = new google.visualization.PieChart(document.getElementById('assets_by_client_domicile'));
                     
                     google.visualization.events.addListener(chart, 'onmouseover', function(e) {
                     // Hide the 2nd row of the tooltip         
                     jQuery('#assets_by_client_domicile svg > g:last-child > g > g:last-child').css('display', 'none');
                     });
                     
                     chart.draw(data, options);
                     }
                  </script>
                  <div style="width:100%; height:270px; float:left;">
                     <div style="background-color:white; width:100%; height:40px; float:left;text-align:center;">
                        <span style="font-family:Georgia; font-size:15px; color:#003A63; margin-top:20px; margin-left:225px; float:left; font-weight:bold;">Assets by Client Type*</span>
                     </div>
                     <div style="background-color:white; width:100%; height:260px; float:left;">
                        <div id="assets_by_client_type" style="width: 480px; height:260px; float: left; padding-left: 80px;">
                           <div style="position: relative;">
                              <div dir="ltr" style="position: relative; width: 480px; height: 260px;">
                                 <div aria-label="Một biểu đồ." style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
                                    <svg width="480" height="260" aria-label="Một biểu đồ." style="overflow: hidden;">
                                       <defs id="defs"></defs>
                                       <rect x="0" y="0" width="480" height="260" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                       <g>
                                          <rect x="316" y="33" width="164" height="107" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                          <g>
                                             <rect x="316" y="33" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                             <g>
                                                <text text-anchor="start" x="333" y="43.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">Sub-advisory Funds: 47%</text>
                                             </g>
                                             <circle cx="322" cy="39" r="6" stroke="none" stroke-width="0" fill="#4c89a5"></circle>
                                          </g>
                                          <g>
                                             <rect x="316" y="52" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                             <g>
                                                <text text-anchor="start" x="333" y="62.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">Public Funds: 17%</text>
                                             </g>
                                             <circle cx="322" cy="58" r="6" stroke="none" stroke-width="0" fill="#2f635c"></circle>
                                          </g>
                                          <g>
                                             <rect x="316" y="71" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                             <g>
                                                <text text-anchor="start" x="333" y="81.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">Taft-Hartley: 7%</text>
                                             </g>
                                             <circle cx="322" cy="77" r="6" stroke="none" stroke-width="0" fill="#6e6e6e"></circle>
                                          </g>
                                          <g>
                                             <rect x="316" y="90" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                             <g>
                                                <text text-anchor="start" x="333" y="100.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">Non-Profit &amp; Other: 4%</text>
                                             </g>
                                             <circle cx="322" cy="96" r="6" stroke="none" stroke-width="0" fill="#73988d"></circle>
                                          </g>
                                          <g>
                                             <rect x="316" y="109" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                             <g>
                                                <text text-anchor="start" x="333" y="119.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">Corporates: 13%</text>
                                             </g>
                                             <circle cx="322" cy="115" r="6" stroke="none" stroke-width="0" fill="#003a63"></circle>
                                          </g>
                                          <g>
                                             <rect x="316" y="128" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                             <g>
                                                <text text-anchor="start" x="333" y="138.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">Insurance: 12%</text>
                                             </g>
                                             <circle cx="322" cy="134" r="6" stroke="none" stroke-width="0" fill="#7b833c"></circle>
                                          </g>
                                       </g>
                                       <g>
                                          <path d="M149,131L230.1661384055193,77.88636732122265A97,97,0,0,1,244.52635204218416,147.84387323369225L149,131A0,0,0,0,0,149,131" stroke="#ffffff" stroke-width="1" fill="#7b833c"></path>
                                       </g>
                                       <g>
                                          <path d="M149,131L165.8438732336922,35.473647957815814A97,97,0,0,1,230.1661384055193,77.88636732122265L149,131A0,0,0,0,0,149,131" stroke="#ffffff" stroke-width="1" fill="#003a63"></path>
                                       </g>
                                       <g>
                                          <path d="M149,131L141.55825427169862,34.28588303398874A97,97,0,0,1,165.84387323369225,35.47364795781583L149,131A0,0,0,0,0,149,131" stroke="#ffffff" stroke-width="1" fill="#73988d"></path>
                                       </g>
                                       <g>
                                          <path d="M149,131L101.08763894132952,46.658991837993796A97,97,0,0,1,141.55825427169862,34.28588303398874L149,131A0,0,0,0,0,149,131" stroke="#ffffff" stroke-width="1" fill="#6e6e6e"></path>
                                       </g>
                                       <g>
                                          <path d="M149,131L52.009455171097486,132.3543314928971A97,97,0,0,1,101.08763894132952,46.658991837993796L149,131A0,0,0,0,0,149,131" stroke="#ffffff" stroke-width="1" fill="#2f635c"></path>
                                       </g>
                                       <g>
                                          <path d="M149,131L244.52635204218416,147.84387323369225A97,97,0,0,1,52.009455171097486,132.3543314928971L149,131A0,0,0,0,0,149,131" stroke="#ffffff" stroke-width="1" fill="#4c89a5"></path>
                                       </g>
                                       <g></g>
                                    </svg>
                                    <div aria-label="Cách trình bày dữ liệu dưới dạng bảng biểu trong biểu đồ." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                       <table>
                                          <thead>
                                             <tr>
                                                <th>Name</th>
                                                <th>Value</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>Sub-advisory Funds: 47%</td>
                                                <td>47</td>
                                             </tr>
                                             <tr>
                                                <td>Public Funds: 17%</td>
                                                <td>17</td>
                                             </tr>
                                             <tr>
                                                <td>Taft-Hartley: 7%</td>
                                                <td>7</td>
                                             </tr>
                                             <tr>
                                                <td>Non-Profit &amp; Other: 4%</td>
                                                <td>4</td>
                                             </tr>
                                             <tr>
                                                <td>Corporates: 13%</td>
                                                <td>13</td>
                                             </tr>
                                             <tr>
                                                <td>Insurance: 12%</td>
                                                <td>12</td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <div aria-hidden="true" style="display: none; position: absolute; top: 270px; left: 490px; white-space: nowrap; font-family: &quot;Arial Narrow&quot;; font-size: 12px; font-weight: bold;">Insurance: 12%</div>
                              <div></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div style="background-color:white; width:100%; height:300px; float:left; margin-top:45px;">
                     <div style="background-color:white; width:100%; height:45px; float:left;text-align:center;">
                        <span style="font-family:Georgia; font-size:15px; color:#003A63; margin-top:20px; margin-left:215px; float:left; font-weight:bold;">Assets by Client Domicile*</span>
                     </div>
                     <div id="assets_by_client_domicile" style="width: 480px; height:250px; float: left; padding-left: 90px;">
                        <div style="position: relative;">
                           <div dir="ltr" style="position: relative; width: 480px; height: 250px;">
                              <div aria-label="Một biểu đồ." style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
                                 <svg width="480" height="250" aria-label="Một biểu đồ." style="overflow: hidden;">
                                    <defs id="defs"></defs>
                                    <rect x="0" y="0" width="480" height="250" stroke="none" stroke-width="0" fill="#ffffff"></rect>
                                    <g>
                                       <rect x="316" y="31" width="164" height="50" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                       <g>
                                          <rect x="316" y="31" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                          <g>
                                             <text text-anchor="start" x="333" y="41.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">North America: 76%</text>
                                          </g>
                                          <circle cx="322" cy="37" r="6" stroke="none" stroke-width="0" fill="#4c89a5"></circle>
                                       </g>
                                       <g>
                                          <rect x="316" y="50" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                          <g>
                                             <text text-anchor="start" x="333" y="60.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">Europe: 17%</text>
                                          </g>
                                          <circle cx="322" cy="56" r="6" stroke="none" stroke-width="0" fill="#7b833c"></circle>
                                       </g>
                                       <g>
                                          <rect x="316" y="69" width="164" height="12" stroke="none" stroke-width="0" fill-opacity="0" fill="#ffffff"></rect>
                                          <g>
                                             <text text-anchor="start" x="333" y="79.2" font-family="Arial Narrow" font-size="12" font-weight="bold" stroke="none" stroke-width="0" fill="#222222">Asia: 7%</text>
                                          </g>
                                          <circle cx="322" cy="75" r="6" stroke="none" stroke-width="0" fill="#6e6e6e"></circle>
                                       </g>
                                    </g>
                                    <g>
                                       <path d="M149,125L108.97674659288315,39.946257068194186A94,94,0,0,1,149,31L149,125A0,0,0,0,0,149,125" stroke="#ffffff" stroke-width="1" fill="#6e6e6e"></path>
                                    </g>
                                    <g>
                                       <path d="M149,125L55.18548752774247,119.09769116424455A94,94,0,0,1,108.97674659288315,39.946257068194186L149,125A0,0,0,0,0,149,125" stroke="#ffffff" stroke-width="1" fill="#7b833c"></path>
                                    </g>
                                    <g>
                                       <path d="M149,125L149,31A94,94,0,1,1,55.18548752774247,119.09769116424455L149,125A0,0,0,1,0,149,125" stroke="#ffffff" stroke-width="1" fill="#4c89a5"></path>
                                    </g>
                                    <g></g>
                                 </svg>
                                 <div aria-label="Cách trình bày dữ liệu dưới dạng bảng biểu trong biểu đồ." style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;">
                                    <table>
                                       <thead>
                                          <tr>
                                             <th>Name</th>
                                             <th>Value</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>North America: 76%</td>
                                             <td>76</td>
                                          </tr>
                                          <tr>
                                             <td>Europe: 17%</td>
                                             <td>17</td>
                                          </tr>
                                          <tr>
                                             <td>Asia: 7%</td>
                                             <td>7</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div aria-hidden="true" style="display: none; position: absolute; top: 260px; left: 490px; white-space: nowrap; font-family: &quot;Arial Narrow&quot;; font-size: 12px; font-weight: bold;">Asia: 7%</div>
                           <div></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="article-content">
                  <p class="fine-print">*AUM shown is as of December 31, 2016. In respect to AUM by client type and domicile, due to rounding, some of the items may not equal 100% or any expressed totals as applicable.
                  </p>
               </div>
            </div>
            <span class="row-separator">&nbsp;</span>
         </div>
         <div class="cf items-row cols-1 row-1">
            <div class="cf item column-1">
               <div class="article-content">
                  <h3>Fixed Income Assets Under Management <span style="text-transform:none">(in Billions)</span></h3>
                  <img src="catalog/view/theme/default/home/images/article_images/aum_chart4Q2016.jpg" alt="aum_chart4Q2016">
                  <p class="fine-print">&nbsp;</p>
               </div>
            </div>
            <span class="row-separator">&nbsp;</span>
         </div>
         <div class="cf items-row cols-1 row-2">
            <div class="cf item column-1">
               <div class="article-content">
                  <h3>Dynamic Strategies with Client Objectives in Mind&nbsp;</h3>
                  <img src="catalog/view/theme/default/home/images/article_images/risk_spectrum2014.jpg" alt="risk_spectrum2014">
                  <p class="fine-print">The above chart is for illustrative purposes only and not drawn to scale. Furthermore, the chart may not reflect the referenced strategies on an expected return and risk basis at any point in time. Potential returns may not be achieved.</p>
                  <br>
                  <div style="border-top-style:solid; border-top-width:1px; border-top-color:grey; margin-top:15px;"><span><br><em>
                     As a SEC-registered investment adviser, MacKay Shields LLC claims compliance with the Global Investment Performance Standards (GIPS®) and prepares and presents its performance reports in compliance with the GIPS standards. The firm receives verification from an independent accounting firm (Ashland Partners &amp; Company LLP) on a quarterly basis. The firm has been independently verified from January 1, 1988 through June 30, 2016.  The effective date of compliance with the GIPS® Standards is January 1, 1988. 
                     Click <a href="mailto:answers@mackayshields.com" style="color:#0a3555; text-decoration:underline;">here</a> to receive the full list and descriptions of MacKay’s active composites that adhere to the GIPS standards.</em></span>
                  </div>
               </div>
            </div>
            <span class="row-separator">&nbsp;</span>
         </div>
      </div>
      <?php } ?>
      <?php if ($_GET['title'] == "senior-leadership-team") { ?>
         <div id="print-region" class="right two-column-right">
   <div class="item-page" itemscope="" itemtype="https://schema.org/Article">
      <meta itemprop="inLanguage" content="en-GB">
      <div itemprop="articleBody">
         <h1>Leadership Team</h1>
         <p>MacKay Shields’ Leadership Team comprises seven senior members of the firm whose responsibilities cover all aspects of the firm’s operations, including portfolio and risk management,&nbsp;client service and business management.</p>
         <p>Members of the committee have substantial experience in the investment industry and are highly regarded in their fields. They report directly to Jeffrey Phlegar, our Chairman and Chief Executive Officer.</p>
         <div class="cf">
            <div class="left">
               <p><a class="con-name alt" href="/leadership/senior-leadership-team/jeffrey-s-phlegar"><br><br><br><br>Jeffrey S. Phlegar</a><br> Chairman and Chief Executive Officer</p>
               <p><a class="con-name" href="/leadership/senior-leadership-team/lucille-p-protas">Lucille P. Protas</a><br> Executive Managing Director<span class="s1"><br> </span>President &amp; Chief Operating Officer<br><br></p>
            </div>
            <div class="left">
               <p><a class="con-name" href="/leadership/senior-leadership-team/john-w-akkerman"><br>John W. Akkerman, CFA, CAIA</a><br> Executive Managing Director<br> Global Head of Distribution</p>
               <p><a class="con-name" href="/leadership/senior-leadership-team/robert-a-dimella">Robert A. DiMella, CFA</a><br> Executive Managing Director<br> Co-Head of Municipal Managers</p>
               <p><a class="con-name" href="/leadership/senior-leadership-team/john-m-loffredo">John M. Loffredo, CFA</a><span class="s1"><br> </span>Executive Managing Director<span class="s1"><br> </span>Co-Head of Municipal Managers</p>
               <p><a class="con-name" href="/leadership/senior-leadership-team/dan-c-roberts">Dan C. Roberts, PhD</a>&nbsp;<br> Executive Managing Director<span class="s1"><br> </span>Head of Global Fixed Income&nbsp;</p>
               <p><a class="con-name" href="/leadership/senior-leadership-team/andrew-susser">Andrew Susser</a>&nbsp;<br> Executive Managing Director<span class="s1"><br> </span>Head of High Yield&nbsp;</p>
            </div>
         </div>
      </div>
   </div>
</div>
      <?php } ?>
      <?php if ($_GET['title'] == "our-history") { ?>
      <div id="print-region" class="right two-column-right">
   <div class="item-page" itemscope="" itemtype="https://schema.org/Article">
      <meta itemprop="inLanguage" content="en-GB">
      <div itemprop="articleBody">
         <h1>OUR HISTORY</h1>
         <p>MacKay Shields’ history dates back to 1938, when we were founded as an economic consulting firm by Gilbert MacKay. As a registered investment adviser since 1969, the firm has been an adopter of new ideas in unsettled markets. This has been demonstrated by the firm’s ability to react to market changes through ongoing product evolution, enabling us to now offer clients a broad array of income-oriented investment strategies across the fixed income spectrum.</p>
         <p>Over the years, MacKay Shields has emerged as a growing player in the investment management business with a commitment to partnering with our clients to deliver tailored income-oriented investment solutions based on their goals and objectives. Our ability to adapt manager skill and strategies, as well as strategies that utilize asset allocation, is what separates us from others. We have the experience and history to demonstrate our long-term commitment to our investment approach, our clients and their portfolios, and our business.&nbsp;</p>
         <p>Our rich history as an investment manager was recognized by New York Life Insurance Company*, which acquired our firm in 1984. MacKay Shields operates and invests independently, which allows us to honor our core principles of maintaining a long-term perspective on the markets and what we believe is right for our clients.&nbsp;</p>
         <p class="fine-print no-border rule">*New York Life Insurance Company formed New York Life Investments in 1999. New York Life Investments is an established money management and investment services firm whose comprehensive capabilities include institutional asset management, retirement plans and full-service products for defined contribution and defined benefit plans.&nbsp; New York Life Investments also manages the retail <span class="s1">MainStay Funds</span>, and MacKay acts as sub-advisor for several of these funds.</p>
         <p class="fine-print no-border">"New York Life Investments" is a service mark used by New York Life Investment Management Holdings LLC and its subsidiary, New York Life Investment Management LLC.</p>
      </div>
   </div>
</div>
      <?php } ?>
      <?php if ($_GET['title'] == "socially-responsible-investing-policy") { ?>
      <div id="print-region" class="right two-column-right">
   <div class="item-page" itemscope="" itemtype="https://schema.org/Article">
      <meta itemprop="inLanguage" content="en-GB">
      <div itemprop="articleBody">
         <h1>SOCIALLY RESPONSIBLE INVESTING POLICY</h1>
        
         <p><b>Overview</b></p>
         <p>MacKay Shields LLC and MacKay Shields UK LLP (collectively, “MacKay Shields”) are proud signatories of the Principles for Responsible Investment (“PRI” or “Principles”), in recognition of the impact that we believe environmental, social and governance (“ESG”) issues can have on long-term investment performance.</p>
         <p><b>The Principles</b></p>
         <p>The PRI provides a framework for incorporating ESG considerations into investment and ownership practices. In becoming a PRI signatory, each of MacKay Shields’ investment teams commits to adopt and implement over time the following six aspirational principles where consistent with our fiduciary duty to clients:</p>
         <p>Principle 1:   Incorporate ESG issues into investment analysis and decision-making processes.</p>
         <p>Principle 2:   Be active owners and incorporate ESG issues into ownership policies and practices.</p>
         <p>Principle 3:   Seek appropriate disclosure on ESG issues by the entities in which we invest.</p>
         <p>Principle 4:   Promote acceptance and implementation of the PRI within the investment industry.</p>
         <p>Principle 5:   Work together to enhance our effectiveness in implementing the PRI.</p>
         <p>Principle 6:   Report activities and progress toward implementing the PRI.</p>
         <p><b>Our Approach</b></p>
         <p>PRI Advisory Committee. MacKay Shields has established an advisory committee charged with overseeing our PRI efforts. The committee includes senior level representation from each of our four portfolio management teams, legal and compliance, client services and senior leadership team.  The committee is chaired by Young Lee, CFA, who is MacKay Shields’ general counsel and co-author of the publication titled “Corporate Governance and ESG: An Introduction” that is part of the CFA Level 1 curriculum. </p>
         <p>Investment and Research. MacKay Shields has access to ESG-related analytical tools and resources, and continues to assess additional third-party offerings. Both MacKay Shields’ High Yield and Convertible teams assign one or more investment professionals to rate each security purchased in its clients’ portfolios based on environmental, social, and governance criteria.  The Global Fixed Income team incorporates certain ESG factors into its fundamental research - most notably pollution and corporate governance.  MacKay Municipal Managers™ commits to assessing ESG screening and rating tools applicable to municipal securities when such tools become available in the future.</p>
         <p>ESG Training. In recognition that best practices in ESG integration are continuously developing, MacKay Shields’ investment professionals are committed to participating in ESG, SRI and PRI-related training programs.</p>
         <p>Reporting. As part of our commitment as a signatory, the firm will report on our ESG activities to the PRI on a comprehensive basis beginning in 2018 for the 2017 calendar year and each year thereafter.</p>
         <p><b>An Ongoing Commitment</b></p>
         <p>We are committed to strengthening and refining our ESG approach through continued dialogue with industry peers and the UNPRI, assessing third party ESG-related analytical tools and resources, participating in ESG training, and conducting regular meetings of the PRI Advisory Committee to augment our ESG-related reporting and research processes and to document existing activities.</p>
      </div>
   </div>
</div>
      <?php } ?>
      <?php if ($_GET['title'] == "in-the-community") { ?>
      <div class="right two-column-right">
   <div class="componentheading">
      In the Community    
   </div>
   <table class="blog" cellpadding="0" cellspacing="0">
      <tbody>
         <tr>
            <td valign="top">
               <p>At MacKay Shields, we are committed to partnering with our local and global communities through volunteering and service.</p>
               <p>Many of our employees have taken active roles in planning and executing a number of volunteer efforts across a variety of projects. Others have participated in our parent company’s Volunteers for Life program in which teams of employees apply for a grant for nonprofit organizations to volunteer their time in both short- and long-term commitments. All of these endeavors enrich the communities where we live as well as work.</p>
               <p><img src="catalog/view/theme/default/home/images/CCFpic5.jpg" border="0" alt="CCFpic5" width="624" height="144"></p>
               <p><img src="catalog/view/theme/default/home/images/alcove2.jpg" border="0" alt="alcove2" width="624" height="350"></p>
               <p><img src="catalog/view/theme/default/home/images/support_our_soldiers.jpg" border="0" alt="support_our_soldiers" width="624" height="144"></p>
               <p><img src="catalog/view/theme/default/home/images/support_our_children.jpg" border="0" alt="support_our_children" width="624" height="144"></p>
               <p><img src="catalog/view/theme/default/home/images/Hearts2.jpg" border="0" alt="Hearts2" width="624" height="144"></p>
               <p><img src="catalog/view/theme/default/home/images/community.jpg" border="0" alt="community" width="624" height="144"></p>
               <h3 class="comm-heading sans">We have demonstrated our commitment in&nbsp;many ways. Since June 2012, we participated in the following community activities:</h3>
            </td>
         </tr>
         <tr>
            <td valign="top">
               <table width="100%" cellpadding="0" cellspacing="0">
                  <tbody>
                     <tr>
                        <td valign="top" width="100%" class="article_column">
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%25 %886 %2012</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#potluck-benefit-for-childrens-cardiomyopathy-foundation-ccf">Potluck Benefit for Children's Cardiomyopathy Foundation (CCF)</a> — In the spirit of sharing and giving back, MacKay Shields held an International Potluck Luncheon at its New York headquarters to benefit CCF.
                                 <a href="/in-the-community-list#potluck-benefit-for-childrens-cardiomyopathy-foundation-ccf">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%25 %886 %2012</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#2015-supporting-children-at-the-alcove">2015 Supporting Children at the Alcove</a> — MacKay Shields employees decorated over 40 Quilts and 40 Pillows from the SoaringWords organization.  These Quilts and Pillows have been donated to The Alcove Center for Grieving Children &amp; Families in New Jersey.
                                 <a href="/in-the-community-list#2015-supporting-children-at-the-alcove">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%05 %886 %2012</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#2014-give-for-good-campaign">2014 Give for Good Campaign</a> — MacKay employees raised a total of $98,184.84, the 7th highest total dollar donation by all New York Life offices.
                                 <a href="/in-the-community-list#2014-give-for-good-campaign">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%05 %886 %2012</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#supporting-our-children">Supporting Our Children</a> — MacKay employees created 31 wish sacks for Make A Wish children and collected over $300 worth of supplies to restock the Alcove’s shelves.
                                 <a href="/in-the-community-list#supporting-our-children">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%05 %886 %2012</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#supporting-our-soldiers">Supporting Our Soldiers</a> — MacKay employees decorated 105 greeting cards, purchased supplies and donated money in order to support our soldiers.
                                 <a href="/in-the-community-list#supporting-our-soldiers">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%03 %886 %2013</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#helping-families-in-need">Helping Families in Need</a> — Parent Company New York Life Donates $100,000 To Relief Efforts In Oklahoma.
                                 <a href="/in-the-community-list#helping-families-in-need">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%30 %886 %2013</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#hearts-of-hope2">Hearts of Hope</a> — Over 50 ceramic keepsake hearts with hand-written messages of hope were painted to support the families of Newtown, Connecticut.
                                 <a href="/in-the-community-list#hearts-of-hope2">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%05 %886 %2012</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#the-alcove">The Alcove</a> — 150 backpacks were assembled with art and craft supplies and other items to assist children during a 12 week bereavement program. The Alcove program provides support for children, teens and adult caregivers who are grieving the death of a loved one.
                                 <a href="/in-the-community-list#the-alcove">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%05 %886 %2012</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#the-wight-foundation">The Wight Foundation</a> — by offering insights into their professions, colleagues at MacKay, in partnership with Madison Square Investors, hosted a Career Day for young men and women of the Greater Newark area.
                                 <a href="/in-the-community-list#the-wight-foundation">Read More</a>
                              </div>
                           </div>
                           <div class="comm-article cf">
                              <!--    <div class="left comm-date">%05 %886 %2012</div>-->
                              <div class="comm-intro full " "=""><a href="/in-the-community-list#dress-for-success-campaign">Dress for Success Campaign</a> — Over 100 clothing and accessory items were collected for disadvantaged women to help them prepare for job interviews.
                                 <a href="/in-the-community-list#dress-for-success-campaign">Read More</a>
                              </div>
                           </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
         <tr>
            <td valign="top" align="center">
               <br>
            </td>
         </tr>
         <tr>
            <td valign="top" align="center">
            </td>
         </tr>
      </tbody>
   </table>
   <p>
   </p>
   <p>Additionally, as a firm we have focused on giving back to the community by working with Gray Matters Community Foundation, Make-A-Wish<span style="font-size: 10px;">®</span> Metro New York and Western New York, Children's Cancer and Blood Foundation, City Meals on Wheels, Girl Scouts of Greater New York and Operation Smile.</p>
   <p></p>
</div>
      <?php } ?>
      <?php if ($_GET['title'] == "contact-us-about-us") { ?>
      <div id="print-region" class="right two-column-right">
   <div class="contact-us">
      <h1>Contact Us</h1>
      <p>If you would like more information about any of MacKay Shields’ strategies and services, please contact John Akkerman for any general marketing and client service questions.</p>
      
   </div>
   <br>
   <div style="margin-top:10px">
      <div style="float:left; width:195px">
         <div class="MM_address"><span class="con-name"><b>HEADQUARTERS:</b></span></div>
         <div class="MM_address"><span class="con-name">MACKAY SHIELDS LLC</span><br>1345 Avenue of the Americas<br>New York, NY 10105</div>
      </div>
      <div style="float:left; width:210px;">
         <div class="MM_address"><span class="con-name"><b>PRINCETON:</b></span></div>
         <div class="MM_address"><span class="con-name">MACKAY MUNICIPAL<br>MANAGERS</span><br>155 Village Blvd, Suite 305<br>Princeton, NJ 08540</div>
         <div style="padding-top:38px">
            <div class="MM_address"><span class="con-name"><b>LOS ANGELES:</b></span></div>
            <div class="MM_address"><span class="con-name">MACKAY SHIELDS LLC</span><br>11150 Santa Monica Blvd<br>Suite 470<br>Los Angeles, CA 90025</div>
         </div>
      </div>
      <div style="float:left">
         <div class="MM_address"><span class="con-name"><b>LONDON:</b></span></div>
         <div class="MM_address"><span class="con-name">MACKAY SHIELDS UK LLP</span><br>200 Aldersgate Street<br>London EC1A 4HD<br>United Kingdom<br>Phone: +44 201 178 7438</div>
         <div class="contact" style="width:200px;float:left;padding-top:20px;">
            <p><span class="con-name">Matthew Nagele</span><br>Managing Director<br>            
               
            </p>
         </div>
      </div>
   </div>
   <div class="fine-print no-border rule" style="float:left;margin-top:25px !important;">
      If you would like more information about any MainStay Fund, please call 1-800-624-6782 for&nbsp;the prospectus, and, if available, the summary prospectus. &nbsp;Investors are asked to consider the investment objectives, risks, and charges and expenses of the investment carefully before investing. The prospectus and, if available,&nbsp;summary prospectus, contains this and other information about the investment company.&nbsp; Please read the prospectus, and, if available, the summary prospectus, carefully before investing.<br><br>
      MacKay Shields UK LLP is authorised and regulated by the Financial Conduct Authority.
   </div>
</div>
      <?php } ?>
      <div class="clearfix"></div>
   </div>
   <div class="clearfix"></div>
</div>
<?php echo $self->load->controller('home/page/footer'); ?> 