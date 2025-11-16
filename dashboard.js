//DASHBOARD SECTION

const navLinks = document.querySelectorAll('.nav-links a');
const sections = document.querySelectorAll('.section');

navLinks.forEach(link => {
    link.addEventListener("click", function (e) {
        e.preventDefault();

        const targetSection = this.getAttribute("data-section");

        // hide all sections
        sections.forEach(sec => sec.style.display = "none");

        // show selected section
        const activeSection = document.getElementById(targetSection);
        if (activeSection) {
            activeSection.style.display = "block";
        }

        // update nav highlight
        navLinks.forEach(nav => {
            nav.classList.remove("active");
            nav.setAttribute("aria-current", "false");
        });
        this.classList.add("active");
        this.setAttribute("aria-current", "true");

        // ==========================================
        // AVIATOR VIDEO AUTOPLAY — FULLY FIXED
        // ==========================================
        const aviatorVideo = document.getElementById("aviatorVideo");

        if (targetSection === "aviator") {
            // wait for DOM to render the visible section
            setTimeout(() => {
                if (aviatorVideo) {
                    aviatorVideo.muted = true;        // autoplay requirement
                    aviatorVideo.currentTime = 0;     // restart
                    aviatorVideo.play().catch(err => {
                        console.log("Autoplay blocked:", err);
                    });
                }
            }, 60);
        } else {
            // pause when leaving aviator
            if (aviatorVideo) {
                aviatorVideo.pause();
                aviatorVideo.currentTime = 0;
            }
        }
    });
});


// Show the dashboard section by default
document.getElementById('dashie').style.display = 'block';

//Change color of active section-icon6
document.querySelectorAll('.nav-links .iconic').forEach(link => {
  link.addEventListener('click', (e) => {
    // clear previous
    document.querySelectorAll('.nav-links .iconic').forEach(l => {
      l.classList.remove('active');
      l.setAttribute('aria-current', 'false');
    });
    // set this one
    link.classList.add('active');
    link.setAttribute('aria-current', 'true');
  });
});


function updateDateTime() {
  const el = document.getElementById('currentDateTime');
  if (!el) return;
  const now = new Date();

  // human friendly text
  const human = now.toLocaleString(undefined, {
    weekday: 'short',    // "Mon"
    year: 'numeric',
    month: 'short',      // "Nov"
    day: 'numeric',
    hour: 'numeric',
    minute: '2-digit',
    second: '2-digit',
    hour12: false        // set true for 12-hour clock
  });

  // machine-readable ISO datetime for the datetime attribute
  el.textContent = human;
  el.setAttribute('datetime', now.toISOString());
}

// initial render and start live updates (every second)
updateDateTime();
const dtTimer = setInterval(updateDateTime, 1000);

(function () {
  // IDs from your markup
  const dayTimeEl = document.getElementById('dayTime');
  const userNamEl = document.getElementById('userNam');

  // Optional: set a preferred timezone (IANA). Set to null to use user's local time.
  const TIMEZONE = 'Africa/Nairobi'; // or null

  // Optional: load user name from localStorage or other source; fallback to "Partner"
  const storedName = localStorage.getItem('userName'); // set earlier if you want persistence
  if (userNamEl) userNamEl.textContent = storedName || 'Partner';

  // Determine greeting from hour (0-23)
  function getGreeting(date) {
    const hr = date.getHours();
    if (hr >= 5 && hr < 12) return 'morning';
    if (hr >= 12 && hr < 17) return 'afternoon';
    if (hr >= 17 && hr < 21) return 'evening';
    return 'night';
  }

  // Helper: get a Date object in the chosen timezone (if TIMEZONE is set)
  function nowInTimeZone(timeZone) {
    if (!timeZone) return new Date();
    // Create a locale string in the target TZ then parse into a Date
    const parts = new Date().toLocaleString('en-US', { timeZone }).replace(',', '');
    return new Date(parts);
  }

  // Update the greeting text
  function updateGreeting() {
    const now = TIMEZONE ? nowInTimeZone(TIMEZONE) : new Date();
    const greeting = getGreeting(now);
    if (dayTimeEl) dayTimeEl.textContent = greeting;
  }

  // Set initial value
  updateGreeting();

  // Recompute at the start of each minute to catch boundary changes
  const msToNextMinute = (60 - new Date().getSeconds()) * 1000 + 50;
  setTimeout(function () {
    updateGreeting();
    setInterval(updateGreeting, 60 * 1000);
  }, msToNextMinute);
})();

// Handle "Upgrade Now" button navigation
document.getElementById('upPkg').addEventListener('click', function (e) {
  e.preventDefault();

  // Target section ID
  const target = this.getAttribute('data-section');
  if (!target) return;

  // Hide all other sections
  document.querySelectorAll('.section').forEach(sec => {
    sec.style.display = 'none';
  });

  // Show the service package section
  document.getElementById(target).style.display = 'block';

  // Optional: highlight the matching sidebar link
  document.querySelectorAll('.nav-links .iconic').forEach(link => {
    link.classList.remove('active');
    link.setAttribute('aria-current', 'false');
  });
  const match = document.querySelector(`.nav-links a[data-section="${target}"]`);
  if (match) {
    match.classList.add('active');
    match.setAttribute('aria-current', 'true');
  }

  // Smooth scroll to top (optional UX touch)
  window.scrollTo({ top: 0, behavior: 'smooth' });
});



//CAPITAL SECTION

document.getElementById('amount').addEventListener('input', calculateProfit);
document.getElementById('duration').addEventListener('change', calculateProfit);

function calculateProfit() {
    const amount = document.getElementById('amount').value;
    const duration = document.getElementById('duration').value;
    let profit;

    switch (duration) {
        case '1-day':
            profit = amount * 1.3;
            break;
        case '2-days':
            profit = amount * 1.5;
            break;
        case '3-days':
            profit = amount * 1.6;
            break;
        case '5-days':
            profit = amount * 1.85;
            break;
        case '10-days':
            profit = amount * 2.0;
            break;
    }

    document.getElementById('profit').textContent = profit.toFixed(2) + ' KES';
}



//DEPOSIT SECTION

document.getElementById('depoForm').addEventListener('submit', function (e) {
  const phone = document.getElementById('phoneNo').value;
  if (!/^\d{10}$/.test(phone)) {
    e.preventDefault();
    alert('Please enter a valid 10-digit phone number.');
  }
});



//WITHDRAW SECTION

// Hide token field initially
const tokenField = document.getElementById('tokenField');
const tokInput = document.getElementById('tokCode');
tokenField.style.display = 'none';
tokInput.removeAttribute('required');

// Toggle token visibility and requirement
document.getElementById('witSource').addEventListener('change', function () {
  const val = this.value;
  const needsToken = ['cashback', 'whatsapp', 'invested'].includes(val);

  if (needsToken) {
    tokenField.style.display = 'block';
    tokInput.setAttribute('required', 'required');
  } else {
    tokenField.style.display = 'none';
    tokInput.removeAttribute('required');
    tokInput.value = ''; // clear token if previously entered
  }
});

// Strict numeric enforcement for phone inputs
['phoneNo', 'witphoneNo'].forEach(id => {
  const input = document.getElementById(id);
  if (!input) return;

  input.addEventListener('input', function () {
    // Strip any non-digit characters (letters, symbols, etc.)
    this.value = this.value.replace(/\D/g, '');

    // Limit to 10 digits
    if (this.value.length > 10) {
      this.value = this.value.slice(0, 10);
    }
  });
});


document.getElementById('witForm').addEventListener('submit', function (e) {
  const phone = document.getElementById('witphoneNo').value;
  if (!/^\d{10}$/.test(phone)) {
    e.preventDefault();
    alert('Please enter a valid 10-digit phone number.');
  }
});



//WHATSAPP SECTION

// Variable to store the uploaded product file.
let currentProductFile = null;

// Listen for file selection on the product image input.
document.getElementById('productImage').addEventListener('change', function(event) {
  const file = event.target.files[0];

  if (file && file.type.startsWith('image/')) {
    // Save the file for later downloading.
    currentProductFile = file;
    
    // Generate a temporary URL for the image preview.
    const imageURL = URL.createObjectURL(file);
    const uploadedImage = document.getElementById('uploadedImage');
    uploadedImage.src = imageURL;
    uploadedImage.style.display = 'block';
    
    // Reveal the download button once the image is loaded.
    document.getElementById('downloadButton').style.display = 'inline-block';
  } else {
    alert("Please select a valid image file");
  }
});

// Download the uploaded image when the download button is clicked.
document.getElementById('downloadButton').addEventListener('click', function() {
  if (currentProductFile) {
    // Create an anchor element to trigger the download.
    const downloadLink = document.createElement('a');
    const fileURL = URL.createObjectURL(currentProductFile);
    downloadLink.href = fileURL;
    downloadLink.download = currentProductFile.name || 'product_image.png';
    
    // Append the link, trigger the download, and then remove the link.
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
    
    // Revoke the object URL to free up resources.
    URL.revokeObjectURL(fileURL);
  }
});


// Calculate "You'll Receive" amount based on no. views multiplied by 150.
document.getElementById('viewsInput').addEventListener('input', function() {
    const noOfViews = parseInt(this.value, 10) || 0;
    const amount = 120 * noOfViews;
    document.getElementById('receive').textContent = amount;
});


// Handle file upload for the "Submit To Earn" section.
document.getElementById('uploadNowButton').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission
    const fileInput = document.getElementById('earnFileInput');
    
    if (fileInput.files && fileInput.files[0]) {
      const file = fileInput.files[0];
      // Generate a temporary URL for the selected file.
      const fileURL = URL.createObjectURL(file);
      
      // Get the container in "My Uploads" Section.
      const uploadsList = document.getElementById('uploadsList');
      
      // If the placeholder is present, remove it.
      const placeholder = document.getElementById('uploadPlaceholder');
      if (placeholder) {
        placeholder.remove();
      }
      
      // Create a new anchor element for the file link.
      const link = document.createElement('a');
      link.href = fileURL;
      link.download = file.name; // This will enable file download.
      link.textContent = file.name;
      link.target = "_blank"; // Opens the file in a new tab if clicked.
      
      // Append the link to the uploads list.
      uploadsList.appendChild(link);
      
      // Clear the file input after upload.
      fileInput.value = "";
    } else {
      alert("Please select a file to upload.");
    }
});


function renderUploads() {
  // clear container
  uploadsList.innerHTML = '';

  // if there are no uploads, show placeholder and return
  if (!uploads || uploads.length === 0) {
    uploadPlaceholder.style.display = 'block';
    return;
  }

  // there are uploads → hide placeholder
  uploadPlaceholder.style.display = 'none';


  // render uploads (newest first)
  uploads.slice().reverse().forEach(item => {
    const row = document.createElement('div');
    row.className = 'upload-row';

    const left = document.createElement('div');
    left.className = 'upload-left';

    const a = document.createElement('a');
    a.className = 'upload-link';
    a.href = item.data;
    a.download = item.name;
    a.textContent = item.name;

    const sub = document.createElement('div');
    sub.className = 'upload-sub';
    sub.textContent = `${new Date(item.created_at).toLocaleString()}`;

    left.appendChild(a);
    left.appendChild(sub);

    const delBtn = document.createElement('button');
    delBtn.className = 'w_button';
    delBtn.style.background = '#ef4444';
    delBtn.textContent = 'Delete';
    delBtn.addEventListener('click', () => {
      uploads = uploads.filter(u => u.id !== item.id);
      localStorage.setItem(LS_KEY, JSON.stringify(uploads));
      renderUploads();
    });

    row.appendChild(left);
    row.appendChild(delBtn);
    uploadsList.appendChild(row);
  });
}

function updatePlaceholderVisibility() {
  uploadPlaceholder.style.display = uploadsList.children.length ? 'none' : 'block';
}


//FOREX SECTION

const forexBtn = document.getElementById("forexSignals");

if (forexBtn) {
    forexBtn.addEventListener("click", () => {
        window.location.href = "https://www.fxtm.com/trading-tools/trading-signals/?utm_source=google&utm_medium=cpc&utm_content=181035816842&utm_term=&utm_campaign=%5BPMG%5D%5BRabbit%5D%5Bbrd:FXTM%5D%5Btgt:DSA%5D%5Bini:BAU%5D%5Bcou:KE%5D%5Blng:EN%5D%5Bchn:PPC%5D%5Bplt:Gogl%5D%5Bstr:GEN+PRSP%5D%5Bopt:pLTV%5D%5Bcjs:NUD%5D%5Blbl:VAL%5D%5BCT:Search%5D%5Bgrp:Convert+%7C+Paid+Search%5D&position=&info=cad_22554963541|gid_181035816842|bid_751885681334|tid_dsa-19959388920&matchtype=&device=c_&geo=9070318&cq_src=google_ads&cq_cmp=22554963541&cq_term=&cq_plac=&cq_net=g&cq_plt=gp&gclsrc=aw.ds&gad_source=1&gad_campaignid=22554963541&gbraid=0AAAAAC3ROqmyaARsnIQKn4D4OqIG9lOa4&gclid=CjwKCAiAt8bIBhBpEiwAzH1w6XK-GzFBaMI5ImiFqusZMzpcaZK9K5oI0nBeIybGUyImQqCk7fErURoCCD4QAvD_BwE;";
    });
}


//AVIATOR SECTION

//DOWNLOAD PREDICTOR BUTTON — OPEN LINK
const aviatorBtn = document.getElementById("downloadAviator");

if (aviatorBtn) {
    aviatorBtn.addEventListener("click", () => {
        window.location.href = "https://www.aviatorgame.net/predictor/";
    });
}



//SERVICE PACKAGE SECTION

var pkgSwiper = new Swiper("#pkgswiper", {
  effect: "cards",
  grabCursor: true,
  loop: true,
  initialSlide: 2,
  rotate: true,
  mousewheel: {
    invert: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

});


//TOKEN SECTION

var tokenSwiper = new Swiper("#tokenswiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  loop: true,
  initialSlide: 2,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 0,
    stretch: 0,   // <- reduce or set to 0
    depth: 250,
    modifier: 1,
    slideShadows: false, // less movement illusion
  },
  on: {
    click(event) {
      const swiper = this;
      if (swiper.clickedSlide) {
        const realIndex = swiper.clickedSlide.getAttribute('data-swiper-slide-index');
        swiper.slideToLoop(realIndex);
      }
    },
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});


//TRANSACTION SECTION

var transSwiper = new Swiper("#transSwiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  loop: true,
  initialSlide: 2,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 0,
    stretch: 0,   // <- reduce or set to 0
    depth: 250,
    modifier: 1,
    slideShadows: false, // less movement illusion
  },
  on: {
    click(event) {
      const swiper = this;
      if (swiper.clickedSlide) {
        const realIndex = swiper.clickedSlide.getAttribute('data-swiper-slide-index');
        swiper.slideToLoop(realIndex);
      }
    },
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});



//MY TEAM SECTION

  // Data: your team rows
  const teamData = [
    { rank: 1,  name: 'Poulinealoo',  phone: '0740662098', deposit: '0.00 KES', membership: '' },
    { rank: 2,  name: 'MarionAkoth',  phone: '0740662098', deposit: '0.00 KES', membership: '' },
    { rank: 3,  name: 'Samash',       phone: '0704712375', deposit: '0.00 KES', membership: '' },
    { rank: 4,  name: 'JoyceMusangi', phone: '0740662098', deposit: '0.00 KES', membership: '' },
    { rank: 5,  name: 'Sharonlugadiru', phone: '0729878606', deposit: '0.00 KES', membership: '' },
    { rank: 6,  name: 'PaulMarino',   phone: '0729878606', deposit: '0.00 KES', membership: 'Elite Membership' },
    { rank: 7,  name: 'Brendaa',      phone: '0795860953', deposit: '0.00 KES', membership: 'Prestige Membership' },
    { rank: 8,  name: 'Rafael254',    phone: '0740662098', deposit: '0.00 KES', membership: '' },
    { rank: 9,  name: 'Asande',       phone: '0713856634', deposit: '0.00 KES', membership: '' },
    { rank:10,  name: 'EugineOman',   phone: '0775645869', deposit: '0.00 KES', membership: 'Elite Membership' },
  ];

  // Helpers
  function membershipBadge(label) {
    if (!label) return '';
    const type = /prestige/i.test(label) ? 'prestige' : 'elite';
    const text = label.replace(/membership/i, '').trim();
    return `<span class="badge badge--${type}" title="${label}">${text}</span>`;
  }

  function createRow(item) {
    return `
      <tr data-rank="${item.rank}" data-name="${item.name}">
        <td>${item.rank}</td>
        <td>${item.name}</td>
        <td class="phone">${item.phone}</td>
        <td class="deposit">${item.deposit}</td>
        <td>${membershipBadge(item.membership)}</td>
        <td>
          <div class="actions">
            <button class="btn btn-delete" type="button" data-action="delete">Delete</button>
            <button class="btn btn-upgrade" type="button" data-action="upgrade">Upgrade</button>
            <button class="btn btn-login" type="button" data-action="login">Login</button>
          </div>
        </td>
      </tr>
    `;
  }

  function renderTable(data) {
    const tbody = document.getElementById('team-body');
    tbody.innerHTML = data.map(createRow).join('');
  }

  // Attach listeners for actions
  function setupActions() {
    const tbody = document.getElementById('team-body');
    tbody.addEventListener('click', (e) => {
      const btn = e.target.closest('button[data-action]');
      if (!btn) return;
      const tr = btn.closest('tr');
      const name = tr?.dataset?.name || 'Unknown';
      const rank = tr?.dataset?.rank || '?';
      const action = btn.dataset.action;

      // TODO: replace alerts with real handlers or API calls
      if (action === 'delete') {
        if (confirm(`Delete member "${name}" (rank ${rank})?`)) {
          tr.remove();
        }
      } else if (action === 'upgrade') {
        alert(`Upgrade requested for "${name}" (rank ${rank}).`);
        // Example: call your API
        // fetch('/api/upgrade', { method:'POST', body: JSON.stringify({ name, rank }) })
      } else if (action === 'login') {
        alert(`Impersonate/login as "${name}" (rank ${rank}).`);
        // Example: redirect or open modal
        // window.location.href = `/admin/login-as?user=${encodeURIComponent(name)}`
      }
    });
  }

  // Initialize
  renderTable(teamData);
  setupActions();

