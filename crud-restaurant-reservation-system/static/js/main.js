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

// Admin Login
document.querySelector(".admin-modal-button").addEventListener("click", () => {
  document.querySelectorAll(".admin-login input").forEach((input, index) => {
    document
      .querySelector(".admin-login-submit")
      .addEventListener("click", (e) => {
        e.preventDefault();
        if (index == 0) input.focus();

        if (input.value) {
          if (index == 0 && input.value == "admin")
            window.location.replace("./admin.php");
        }
      });
  });
});
