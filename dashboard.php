<?php
session_start();
include("connect.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
// Fetch user info from DB
$stmt = $conn->prepare("SELECT username, phone, email FROM users WHERE id=? LIMIT 1");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$username = htmlspecialchars($row['username']);
$phone    = htmlspecialchars($row['phone']);
$email    = htmlspecialchars($row['email']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyalBridge Adverts</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Logo" class="logo-image">
            <span>ROYALBRIDGE</span>
        </div>
        <div class="line"></div>
        <nav class="nav-links">
            <a href="#" data-section="dashie" aria-current="true" class="iconic"><span class="material-symbols-outlined">dashboard</span><span class="spacie"> Dashboard</span></a>
            <a href="#" data-section="deposit" aria-current="false" class="iconic"><span class="material-symbols-outlined">payment_arrow_down</span> <span class="spacie">Deposit</span></a>
            <a href="#" data-section="capital" aria-current="false" class="iconic"><span class="material-symbols-outlined">currency_exchange</span><span class="spacie"> Capital</span></a>
            <a href="#" data-section="withdrawal" aria-current="false" class="iconic"><span class="material-symbols-outlined">money_bag</span> <span class="spacie">Withdrawal</span></a>
            <a href="#" data-section="transactions" aria-current="false" class="iconic"><span class="material-symbols-outlined">money_range</span><span class="spacie"> Transactions</span></a>
            <a href="#" data-section="whatsAPP" aria-current="false" class="iconic"><i class="fab fa-whatsapp"></i> Whatsapp</a>
            <a href="#" data-section="aviator" aria-current="false" class="iconic"><span class="material-symbols-outlined">flight_takeoff</span> <span class="spacie">Aviator</span></a>
            <a href="#" data-section="forex" aria-current="false" class="iconic"><span class="material-symbols-outlined">finance_mode</span> <span class="spacie">Forex</span></a>
            <a href="#" data-section="myteam" aria-current="false" class="iconic"><i class="fas fa-users"></i> My Team</a>
            <a href="#" data-section="servicepackage" aria-current="false" class="iconic"><i class="fas fa-box"></i> Service Package</a>
            <a href="#" data-section="token" aria-current="false" class="iconic"><span class="material-symbols-outlined">price_check</span> <span class="spacie">Tokens</span></a>
            <a href="#" data-section="feedback" aria-current="false" class="iconic"><span class="material-symbols-outlined">feedback</span> <span class="spacie">Feedback</span></a>
            <a href="#" data-section="acctMgt" aria-current="false" class="iconic"><span class="material-symbols-outlined">manage_accounts</span> <span class="spacie">Account</span></a>
            <a id="logOut" href="logout.php" aria-current="false" class="iconic"><span class="material-symbols-outlined">logout</span><span class="spacie"> Log-out</span></a>
        </nav>
    </div>
    
    <div class="righties">
        <div class="top">
            <p>RoyalBridge Adverts</p>
            <img class="rightLogo" id="rightLogo" src="logo.png" alt="Logo" class="logo-image">
        </div>
 
        
        <!--DASHBOARD SECTION-->
        <section id="dashie" class="section">
            <div class="dashBoard">
                
                <p class="dash"><a href="#"><span class="material-symbols-outlined">dashboard</span> Dashboard</a></p>

                <div class="dashboard">
                    <div class="notification">
                        <h1>Good <span id="dayTime" class="dayTime">morning</span>, <span id="userName" class="userName">Partner</span></h1>
                        <p> Your account is ready! We've sent you an email to confirm and claim your account. Check your inbox or Spam folder and click the link to get started. Enjoy! 😊<br></p>
                        <time id="currentDateTime" datetime="" aria-live="polite"></time>
                    </div>
                </div>

            
                <div class="balances">
                    <div class="scroll-container">
                        <div class="package">
                            <h2 class="top-left">My Package</h2>
                            <button id="upPkg" class="upPkg" href="#" data-section="servicepackage">Upgrade Now</button>
                            <p id="pack" class="bottom-left p_posn">NO PACKAGE</p>
                        </div>
                        <div class="whatsapp">
                            <h2 class="top-left">Whatsapp Balance</h2>
                            <p id="watBal" class="bottom-left">KES 0.00</p>
                        </div>
                        <div class="totalwhatsapp">
                            <h2 class="top-left">Whatsapp Withdrawal</h2>
                            <p id="watWith" class="bottom-left">KES 0.00</p>
                        </div>
                        <div class="totalwithdrawal">
                            <h2 class="top-left">Total Withdrawal</h2>
                            <p id="totWith" class="bottom-left">KES 0.00</p>
                        </div>
                        <div class="account">
                            <h2 class="top-left">Account Balance</h2>
                            <p id="accBal" class="bottom-left">KES 0.00</p>
                        </div>
                        <div class="affiliate">
                            <h2 class="top-left">Affiliate Balance</h2>
                            <p id="refBal" class="bottom-left">KES 0.00</p>
                        </div>
                        <div class="cashback">
                            <h2 class="top-left">Cashback Withdrawn</h2>
                            <p id="backWith" class="bottom-left">KES 0.00</p>
                        </div>
                        <div class="cashbackbalance">
                            <h2 class="top-left">Cashback Balance</h2>
                            <p id="backBal" class="bottom-left">KES 0.00</p>
                        </div>
                        <div class="invested">
                            <h2 class="top-left">Invested Earnings</h2>
                            <p id="invEarn" class="bottom-left">KES 0.00</p>
                        </div>
                        <div class="depositBal">
                            <h2 class="top-left">Deposit Balance</h2>
                            <p id="depBal" class="bottom-left">KES 0.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--DEPOSIT SECTION-->
        <section id="deposit" class="section" style="display: none;">
            <div class="depositsect">
                <!-- Left column -->
                <div class="depoLeft">
                    <section class="depocard" id="depoRequestSect">
                        <div class="mpesa-brand">
                            <img class="mpesa-logo" src="./images/mpesa.jpg" alt="M-Pesa Logo">
                            <div class="request-deposit">
                                <h2 id="request-title">Deposit</h2>
                            </div>
                        </div>

                        <form id="depoForm" autocomplete="off" novalidate>
                            <div class="depoFormAmnt">
                                <label id="depoLabel" for="depoAmount">Amount (KES)</label>
                                <input id="depoAmount" class="depoinput" name="amount" type="number" min="1" step="1" placeholder="Deposit Amount" required>
                            </div>

                            <div class="depoFormPhone">
                                <label id="depoLabel" for="depoPhone">Phone Number</label>
                                <input id="phoneNo" class="depoinput" name="phone" type="tel" placeholder="0712345678" maxlength="10" inputmode="numeric" required>
                            </div>
                            
                            <div class="form-actions">
                                <button id="requestBtn" class="depobtn" type="submit">Deposit</button>
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Right column -->
                <div class="depoRight">
                    <div class="transactions-header">
                        <h2 id="transactions-title"> Deposited Transactions</h2>
                    </div>
                    <section class="depoTransactions" id="transactionsTitle">
                        <div id="depoTransList" class="depoTranslist" role="list" aria-live="polite"></div>
                    </section>
                </div>
            </div> 

        </section>


        <!--CAPITAL SECTION-->
        <section id="capital" class="section" style="display: none;">
            <p class="cap"><a href="#"><span class="material-symbols-outlined">payments</span> Capital</a></p>
            <div class="capitalSect">
                <h1>Apply-Your Investment</h1>
                <form>
                    <div class="form-group">
                        <label for="duration">Select Duration:</label>
                        <select id="duration" name="duration"> 
                            <option value="1-day">1-Day</option>
                            <option value="2-days">2-Days</option>
                            <option value="3-days">3-Days</option>
                            <option value="5-days">5-Days</option>
                            <option value="10-days">10-Days</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" value="1">
                    </div>

                    <div class="profit">
                        Your profit: <span id="profit">1.30 KES</span> 
                    </div>
                    
                    <button type="submit">Invest-Now</button>
                </form>
            </div>
              
        </section>

 
        <!--WITHDRAWAL SECTION-->
        <section id="withdrawal" class="section" style="display: none;">
            <div class="witsect">
                <section class="witcard" id="witRequest">
                    <div class="mpesa-brand">
                        <div class="request-withdraw">
                            <h2 id="wit-title">Withdraw</h2>
                        </div>
                    </div>

                    <form id="witForm" autocomplete="off" novalidate>
                        <label for="witphoneNo">Phone Number</label>
                        <input id="witphoneNo" class="witinput" name="phone" type="tel" placeholder="0712345678" maxlength="10" inputmode="numeric" required>

                        <label for="witSource">Choose Wallet</label>
                        <select id="witSource" class="witinput" name="source" required>
                            <option value="" disabled selected>Select Wallet</option>
                            <option value="cashback">Cashback</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="affiliates">Affiliates</option>
                            <option value="invested">Invested Earnings</option>
                        </select>

                        <div id="tokenField">
                            <label for="tokCode">Token</label>
                            <input id="tokCode" class="witinput" name="tokCode" type="number" min="1" step="1" placeholder="Token Code">
                        </div>

                        <label for="witAmount">Amount (KES)</label>
                        <input id="witAmount" class="witinput" name="amount" type="number" min="1" step="1" placeholder="Withdrawal Amount" required>

                        <div class="form-actions">
                            <button id="witBtn" class="witbtn" type="submit">Withdraw</button>
                        </div>
                    </form>
                </section>
            </div>            
        </section> 


        <!--TRANSACTIONS SECTION-->
        <section id="transactions" class="section" style="display: none;">
            <div id="transSect" class="transSect">
                <div id="transSwiper" class="swiper">
                    <div id="transWrapper" class="swiper-wrapper">
                        <div id="depoTrans" class="swiper-slide">
                            <div class="transTitle">
                                <h1>Deposits</h1>
                            </div>
                            <div class="transList">
                                <p id="transPlaceholder">Your Records will Appear here</p>
                                <!-- Container to hold uploaded file links -->
                                <div id="transList"></div>
                            </div>
                        </div>

                        <div id="capitalTrans" class="swiper-slide">
                            <div class="transTitle">
                                <h1>Investments</h1>
                            </div>
                            <div class="transList">
                                <p id="transPlaceholder">Your Records will Appear here</p>
                                <!-- Container to hold uploaded file links -->
                                <div id="transList"></div>
                            </div>

                        </div>

                        <div id="whatsappTrans" class="swiper-slide">
                            <div class="transTitle">
                                <h1>WhatsApp</h1>
                            </div>
                            <div class="transList">
                                <p id="transPlaceholder">Your Records will Appear here</p>
                                <!-- Container to hold uploaded file links -->
                                <div id="transList"></div>
                            </div>
                        </div>

                        <div id="cashbackTrans" class="swiper-slide">
                            <div class="transTitle">
                                <h1>Cashback</h1>
                            </div>
                            <div class="transList">
                                <p id="transPlaceholder">Your Records will Appear here</p>
                                <!-- Container to hold uploaded file links -->
                                <div id="transList"></div>
                            </div>
                        </div>

                        <div id="aviatorTrans" class="swiper-slide">
                            <div class="transTitle">
                                <h1>Aviator</h1>
                            </div>
                            <div class="transList">
                                <p id="transPlaceholder">Your Records will Appear here</p>
                                <!-- Container to hold uploaded file links -->
                                <div id="transList"></div>
                            </div>
                        </div>

                        <div id="forexTrans" class="swiper-slide">
                            <div class="transTitle">
                                <h1>Forex</h1>
                            </div>
                            <div class="transList">
                                <p id="transPlaceholder">Your Records will Appear here</p>
                                <!-- Container to hold uploaded file links -->
                                <div id="transList"></div>
                            </div>
                        </div>

                        <div id="affiliateTrans" class="swiper-slide">
                            <div class="transTitle">
                                <h1>Affiliates</h1>
                            </div>
                            <div class="transList">
                                <p id="transPlaceholder">Your Records will Appear here</p>
                                <!-- Container to hold uploaded file links -->
                                <div id="transList"></div>
                            </div>
                        </div>

                        <div id="withTrans" class="swiper-slide">
                            <div class="transTitle">
                                <h1>Withdrawals</h1>
                            </div>
                            <div class="transList">
                                <p id="transPlaceholder">Your Records will Appear here</p>
                                <!-- Container to hold uploaded file links -->
                                <div id="transList"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--WHATSAPP SECTION-->
        <section id="whatsAPP" class="section" style="display: none;">
            <p class="wat"><a href="#" data-section="whatsapp"><i class="fab fa-whatsapp"></i> Whatsapp</a></p>
            <div class="whatsApp">
                <div class="w_product">
                    <h2>Today's Product</h2>
                    <div class="w_img-section">
                        <img id="uploadedImage" alt="Uploaded Product" style="display: none;">
                    </div>
                    <form id="upload-form" action="upload.php" method="post" enctype="multipart/form-data"> 
                        <input type="file" name="productImage" id="productImage"> 
                        <button type="submit" class="fancy-btn"><span>Upload Product Image</span></button> 
                    </form>
                    <button id="downloadButton" class="w_button" style="display: none;">Download Product</button>
                </div>
                <div class="w_submit">
                    <h2>Submit To Earn</h2>
                    <div class="w_form-group">
                      <input type="number" id="viewsInput" placeholder="No. Views">
                    </div>
                    <div class="w_form-group">
                      <input type="number" placeholder="Your Phone">
                    </div>
                    <div class="receive">
                      You'll Receive: <span id="receive">0</span>
                    </div>
                    <div class="w_form-group">
                        <!-- Added id to file input for the Submit To Earn section -->
                        <input type="file" id="earnFileInput">
                    </div>
                    <!-- Added id to button -->
                    <button id="uploadNowButton" class="w_button">Upload Now</button>
                </div>
                <div class="w_uploads"> 
                    <h2>My Uploads</h2>
                    <p id="uploadPlaceholder">Your Records will Appear here</p>
                    <!-- Container to hold uploaded file links -->
                    <div id="uploadsList" class="uploadsList"></div>
                </div> 
            </div>
        </section>
        

        <!--FOREX SECTION-->
        <section id="forex" class="section" style="display: none;">
            <div class="tradingview-widget-container">
                <div id="tradingview_advanced_chart"></div>
                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                <script type="text/javascript">
                    new TradingView.widget({
                    width: "100%",
                    height: 450,
                    symbol: "FX:EURUSD", // Change to your preferred pair
                    interval: "D",
                    timezone: "Africa/Nairobi",
                    theme: "dark",
                    style: "1",
                    locale: "en",
                    toolbar_bg: "#f1f3f6",
                    enable_publishing: false,
                    allow_symbol_change: true,
                    container_id: "tradingview_advanced_chart"
                    });
                </script>
            </div>
            <button id="forexSignals" class="forex-btn">Forex Signals</button>

        </section>


        <!--AVIATOR SECTION-->
        <section id="aviator" class="section" style="display: none;">
            <div class="aviatorSect">
                <div class="aviator-video-container">
                    <video id="aviatorVideo" muted loop playsinline>
                        <source src="./images/aviator.mp4" type="video/mp4">
                    </video>

                    <button id="downloadAviator" class="aviator-btn" href="https://www.aviatorgame.net/predictor/">Download Predictor</button>
                </div>

                <div class="aviator-right">
                    <h2>Soar Above the Odds with Aviator Ace — Your Winning Wingman!</h2>
                    <p><span class="material-symbols-outlined">flight_takeoff</span><span class="spacie">Ready to stop guessing and start winning?</span></p>
                    <p><span class="material-symbols-outlined">flight_takeoff</span><span class="spacie">Aviator Ace uses cutting-edge prediction tech to help you ride the waves of the game with confidence.</span></p>
                    <p><span class="material-symbols-outlined">flight_takeoff</span><span class="spacie">Whether you're a high-flyer or just getting started, this app gives you the edge to land big wins — fast, smart, and smooth.</span></p>
                    <p><span class="material-symbols-outlined">flight_takeoff</span><span class="spacie">💡 Predict smarter. Bet bolder. Fly higher.</span></p>
                </div>
            </div>
        </section>
        

        <!--MY_TEAM SECTION-->
        <section id="myteam" class="section" style="display: none;">
            <div class="teamSect">
                <h2 id="my-team-title">My-Team</h2>

                <div class="table-wrap">
                    <table class="team-table">
                        <thead>
                            <tr>
                                <th scope="col">Rank</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Deposit</th>
                                <th scope="col">Package</th>
                                <th scope="col" class="actions-col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="team-body">
                            <!-- Rows are injected by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
            
        </section>

        <!--SERVICE_PACKAGE SECTION-->
        <section id="servicepackage" class="section" style="display: none;">
            <div class="servicePkg">

                <div class="textPkg">
                    <div class="elitetext">
                        <h2 class="pkg">Elite Membership</h2>
                        <ul>
                            <li><span class="material-symbols-outlined">attach_money</span>Advertise and earn once a week</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Get cashback reward of Ksh. 2,000</li>
                        </ul>
                        <button id="pkgprice" class="pkgprice">Buy 1,000.00 KES</button>
                    </div>

                    <div class="prestigetext">
                        <h2 class="pkg">Prestige Membership</h2>
                        <ul>
                            <li><span class="material-symbols-outlined">attach_money</span>Advertise and earn thrice a week</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Get cashback reward of Ksh. 5,000</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Free Forex signal Once a week</li>
                        </ul>
                        <button id="pkgprice" class="pkgprice">Buy 2,500.00 KES</button>
                    </div>

                    <div class="deluxetext">
                        <h2 class="pkg">Deluxe Membership</h2>
                        <ul>
                            <li><span class="material-symbols-outlined">attach_money</span>Advertise and earn 5 times a week</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Get cashback reward of Ksh. 7,000</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Free Forex signal twice a week</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Fast Pay</li>
                        </ul>
                        <button id="pkgprice" class="pkgprice">Buy 3,500.00 KES</button>
                    </div>

                    <div class="grandtext">
                        <h2 class="pkg">Grand Membership</h2>
                        <ul>
                            <li><span class="material-symbols-outlined">attach_money</span>Advertise and earn daily</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Get cashback reward of Ksh. 10,000</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Free Forex signal thrice a week</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Free Aviator prediction once a week</li>
                            <li><span class="material-symbols-outlined">attach_money</span>Instant Pay</li>
                        </ul>
                        <button id="pkgprice" class="pkgprice">Buy 5,000.00 KES</button>
                    </div>
                    
                </div>
            
                <div class="swipsect">
                    <div id="pkgswiper" class="swiper">
                        <div id="pkgwrapper" class="swiper-wrapper">
                            <div id="eliteM" class="swiper-slide">
                                <h2 class="eliteMemb">Elite Membership</h2>
                            </div>
                            <div id="prestigeM" class="swiper-slide">
                                <h2 class="prestigeMemb">Prestige Membership</h2>
                            </div>
                            <div id="deluxeM" class="swiper-slide">
                                <h2 class="deluxeMemb">Deluxe Membership</h2>
                            </div>
                            <div id="grandM" class="swiper-slide">
                                <h2 class="grandMemb">Grand Membership</h2>
                            </div>
                            <div id="eliteM" class="swiper-slide">
                                <h2 class="eliteMemb">Elite Membership</h2>
                            </div>
                            <div id="prestigeM" class="swiper-slide">
                                <h2 class="prestigeMemb">Prestige Membership</h2>
                            </div>
                            <div id="deluxeM" class="swiper-slide">
                                <h2 class="deluxeMemb">Deluxe Membership</h2>
                            </div>
                            <div id="grandM" class="swiper-slide">
                                <h2 class="grandMemb">Grand Membership</h2>
                            </div>
                            <div id="eliteM" class="swiper-slide">
                                <h2 class="eliteMemb">Elite Membership</h2>
                            </div>
                            <div id="prestigeM" class="swiper-slide">
                                <h2 class="prestigeMemb">Prestige Membership</h2>
                            </div>
                            <div id="deluxeM" class="swiper-slide">
                                <h2 class="deluxeMemb">Deluxe Membership</h2>
                            </div>
                            <div id="grandM" class="swiper-slide">
                                <h2 class="grandMemb">Grand Membership</h2>
                            </div>
                            <div id="eliteM" class="swiper-slide">
                                <h2 class="eliteMemb">Elite Membership</h2>
                            </div>
                            <div id="prestigeM" class="swiper-slide">
                                <h2 class="prestigeMemb">Prestige Membership</h2>
                            </div>
                            <div id="deluxeM" class="swiper-slide">
                                <h2 class="deluxeMemb">Deluxe Membership</h2>
                            </div>
                            <div id="grandM" class="swiper-slide">
                                <h2 class="grandMemb">Grand Membership</h2>
                            </div>
                        </div>
                    </div>
                    <div id="pkgpag" class="swiper-pagination"></div>
                </div>
            </div>

        </section>

        <!--TOKEN SECTION-->
        <section id="token" class="section" style="display: none;">
            <div class="tokenpkg">
                <div id="tokenswiper" class="swiper">
                    <div id="tokenwrapper" class="swiper-wrapper">
                        <div id="verSlide" class="swiper-slide">
                            <h2 class="tok">Verification Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>Aviator Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Unlock Token</li>
                            </ul>
                            <button class="tokprice">Buy 3,500.00 KES</button>
                        </div>

                        <div id="authSlide" class="swiper-slide">
                            <h2 class="tok">Authorization Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Authorization Token</li>
                            </ul>
                            <button class="tokprice">Buy 5,500.00 KES</button>
                        </div>

                        <div id="credSlide" class="swiper-slide">
                            <h2 class="tok">Credentials Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Forex Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Verification Token</li>
                            </ul>
                            <button class="tokprice">Buy 7,500.00 KES</button>
                        </div>

                        <div id="luxSlide" class="swiper-slide">
                            <h2 class="tok">Luxurious Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Forex Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Add Agent</li>
                            </ul>
                            <button class="tokprice">Buy 10,000.00 KES</button>
                        </div>

                        <div id="verSlide" class="swiper-slide">
                            <h2 class="tok">Verification Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>Aviator Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Unlock Token</li>
                            </ul>
                            <button class="tokprice">Buy 3,500.00 KES</button>
                        </div>

                        <div id="authSlide" class="swiper-slide">
                            <h2 class="tok">Authorization Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Authorization Token</li>
                            </ul>
                            <button class="tokprice">Buy 5,500.00 KES</button>
                        </div>

                        <div id="credSlide" class="swiper-slide">
                            <h2 class="tok">Credentials Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Forex Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Verification Token</li>
                            </ul>
                            <button class="tokprice">Buy 7,500.00 KES</button>
                        </div>

                        <div id="luxSlide" class="swiper-slide">
                            <h2 class="tok">Luxurious Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Forex Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Add Agent</li>
                            </ul>
                            <button class="tokprice">Buy 10,000.00 KES</button>
                        </div>

                        <div id="verSlide" class="swiper-slide">
                            <h2 class="tok">Verification Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>Aviator Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Unlock Token</li>
                            </ul>
                            <button class="tokprice">Buy 3,500.00 KES</button>
                        </div>

                        <div id="authSlide" class="swiper-slide">
                            <h2 class="tok">Authorization Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Authorization Token</li>
                            </ul>
                            <button class="tokprice">Buy 5,500.00 KES</button>
                        </div>

                        <div id="credSlide" class="swiper-slide">
                            <h2 class="tok">Credentials Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Forex Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Verification Token</li>
                            </ul>
                            <button class="tokprice">Buy 7,500.00 KES</button>
                        </div>

                        <div id="luxSlide" class="swiper-slide">
                            <h2 class="tok">Luxurious Code</h2>
                            <ul>
                                <li><span class="material-symbols-outlined">attach_money</span>WhatsApp Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Forex Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Tripled Cashback Approval</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Investment withdrawal</li>
                                <li><span class="material-symbols-outlined">attach_money</span>Add Agent</li>
                            </ul>
                            <button class="tokprice">Buy 10,000.00 KES</button>
                        </div>   

                    </div>

                    <div id="tokenpag" class="swiper-pagination"></div>
                    
                </div>
            </div>

        </section>


        <!--FEEDBACK SECTION-->
        <section id="feedback" class="section" style="display: none;">
            <div class="feedbackSect">
                <div class="feedback-form-container">
                    <h1>GET IN TOUCH</h1>
                    <h2>We're here to help</h2>
                    <p>Have questions or need assistance? Reach out to us for any inquiries or support. Let's connect!</p>
                    <form action="">
                        <div class="feedNameSect">
                            <label id="feedLabel" for="feedname">Name *</label>
                            <input id="feedinput" type="text" name="name" placeholder="Enter your full name" required>
                         
                        </div>
                        
                        <div class="feedMailSect">
                            <label id="feedLabel" for="feedmail">Email *</label>
                            <input id="feedinput" type="email" id="feedinput" name="email" placeholder="example@gmail.com" required>
                        </div>

                        <div class="feedPhoneSect">
                            <label id="feedLabel" for="feedphone">Phone *</label>
                            <input id="feedinput" type="tel" id="feedinput" name="phone" placeholder="0712345678" required>
                        </div>
                        
                        <div class="feedMsgSect">
                            <label id="feedMsgLabel" for="feedmessage">Message</label>
                            <textarea id="feedmsg" name="message"></textarea>
                        </div>
                        
                        <label  class="allow"><input class="boxie" type="checkbox" name="consent" required>I allow this website to store my submission so they can respond to my inquiry. *</label>
                        
                        <button class="sub" type="submit">SUBMIT</button>
                    </form>
                </div>


                <div class="feedback-info-container">
                    <div class="royalBridge">
                        <img class="royalBridgelogo" src="logo.png" alt="Royal Bridge Logo">
                    </div>

                    <h2>Get in touch</h2>
                    
                    <p><strong>E-mail:</strong> royalbridge@gmail.com</p>
                    
                    <p class="cont"><strong>Contacts:</strong></p>
                    <ul>
                        <li><a href="tel:0712345678">0712345678</a></li>
                    </ul>
                </div>
            </div>
        </section>
        

        <!--ACCOUNT MANAGEMENT SECTION-->
        <section id="acctMgt" class="section" style="display: none;">
            <div class="account-section">
                <img src="logo.png" alt="Logo" class="profile-logo">

                <h2>@<span id="userName">Username</span></h2>
                <p><span class="acctTitle">Username:</span> <span id="userName">Username</span></p>
                <p><span class="acctTitle">Package:</span> <span id="pkg" class="highlight">Elite Membership</span></p>
                <p><span class="acctTitle">Email:</span> <span id="emailAddress">email@gmail.com</span></p>
                <p><span class="acctTitle">Phone:</span> <a href="tel:0712345678"><span id="telNo">0712345678</span></a></p>
                <p><span class="acctTitle">Rank:</span> <span id="rank">CEO</span></p>
                <p><span class="acctTitle">My Link:</span> <span id="myLink" class="highlight active"></span></p>

                <div class="acct-actions">
                    <button id="editDetails" class="edit-acct-btn">Edit</button>
                    <a href="logout.php" class="logout-btn">Log Out</a>
                </div>
            </div>
        </section>
        
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="dashboard.js"></script>
    <script src="js/app.js"></script>

    <script>
        const USERNAME = "<?php echo $username; ?>";
        const PHONE    = "<?php echo $phone; ?>";
        const EMAIL    = "<?php echo $email; ?>";
    </script>
    <script src="user.js"></script>
    
</body>
</html>
