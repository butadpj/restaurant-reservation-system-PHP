const dateDisplay = document.querySelectorAll(".date-display");
const months = {
  0: "January",
  1: "February",
  2: "March",
  3: "April",
  4: "May",
  5: "June",
  6: "July",
  7: "August",
  8: "September",
  9: "October",
  10: "November",
  11: "December",
};

dateDisplay.forEach((dateFields) => {
  const dateRawSplit = dateFields.textContent.split("/");

  const date = new Date(dateRawSplit[2], dateRawSplit[0], dateRawSplit[1]);
  const m = date.getMonth();
  const month = months[m - 1]; // Cancel Month's zero-index based
  const day = date.getDate();
  const year = date.getFullYear();

  console.log(month, day, year);

  dateFields.textContent = `${month} ${day}, ${year}`;
});

function setWithExpiry(key, value, ttl) {
  const now = new Date();

  // `item` is an object which contains the original value
  // as well as the time when it's supposed to expire
  const item = {
    value: value,
    expiry: now.getTime() + ttl,
  };
  localStorage.setItem(key, JSON.stringify(item));
}

function getWithExpiry(key) {
  const itemStr = localStorage.getItem(key);
  // if the item doesn't exist, return null
  if (!itemStr) {
    return null;
  }
  const item = JSON.parse(itemStr);
  const now = new Date();
  // compare the expiry time of the item with the current time
  if (now.getTime() > item.expiry) {
    // If the item is expired, delete the item from storage
    // and return null
    localStorage.removeItem(key);
    return null;
  }
  return item.value;
}

// Admin Login
let isAuthenticated = getWithExpiry("isAuthenticated") || false;

let adminModalButton = document.querySelector(".admin-modal-button");

let username = "admin";
let password = "1234";

let inputUsername = "";
let inputPassword = "";
let usernameField;
let passwordField;

adminModalButton.addEventListener("click", () => {
  if (isAuthenticated) {
    window.location.replace(`./admin.php`);
  } else {
    let adminInputs = document.querySelectorAll(".admin-login input");
    adminInputs.forEach((input, index) => {
      if (index == 0) usernameField = input;
      if (index == 1) passwordField = input;
      input.addEventListener("input", () => {
        if (input.value) {
          if (index == 0) {
            inputUsername = input.value;
          }
          if (index == 1) {
            inputPassword = input.value;
          }
        }
      });
    });

    let adminLoginSubmit = document.querySelector(".admin-login-submit");
    adminLoginSubmit.addEventListener("click", (e) => {
      e.preventDefault();
      if (inputUsername === username && inputPassword === password) {
        // localStorage.setItem("isAuthenticated", "true");
        setWithExpiry("isAuthenticated", true, 300000); // Expires in 5 minutes
        isAuthenticated = true;
        window.location.replace(`./admin.php`);
      } else {
        alert("Invalid credentials");
        passwordField.value = "";
      }
    });
  }
});

if (isAuthenticated) {
  adminModalButton.textContent = "Go to Admin Panel";
}
