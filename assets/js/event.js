$(document).ready(function () {
  if (localStorage.getItem("comment") != null) {
    $("#indicator").html(localStorage.getItem("comment"));
    if (localStorage.getItem("cmtClass") == "true") {
      $("#indicator").removeClass("alert-info");
      $("#indicator").removeClass("alert-danger");
      $("#indicator").addClass("alert-success");
    } else {
      $("#indicator").removeClass("alert-success");
      $("#indicator").removeClass("alert-info");
      $("#indicator").addClass("alert-danger");
    }
    localStorage.removeItem("comment");
    localStorage.removeItem("cmtClass");
  } else {
    $("#indicator").html("Click On Date To Request Meeting..");
    $("#indicator").removeClass("alert-success");
    $("#indicator").removeClass("alert-danger");
    $("#indicator").addClass("alert-info");
  }

  $("tbody").on("click", ".gate", function (e) {
    $("#meetingDate").removeClass("btn btn-outline-danger");
    $("#meetingDate").val(this.getAttribute("data-ddate"));
    $("#eventModal").modal("show");
  });

  $("small").on("click", ".trash", function (e) {
    var id = this.getAttribute("data-id");
    $.post(
      "tempFunction/deleteMeeting.php",
      {
        id: id,
      },
      function (response) {
        localStorage.setItem("comment", response);
        localStorage.setItem("cmtClass", false);
        location.reload();
      }
    );
  });

  setTimeout(function () {
    $("#indicator").html("Click On Date To Request Meeting..");
    $("#indicator").removeClass("alert-success");
    $("#indicator").removeClass("alert-danger");
    $("#indicator").addClass("alert-info");
  }, 3000);

  $(".clickCheck").click(function () {
    $(this).find("small").toggleClass("d-none");
  });
});
// Vast
updateCalendar(0);
function updateCalendar(data) {
  const inputMonth = $("#inputMonth").val();
  const inputYear = $("#inputYear").val();

  $.post(
    "usefulFunction/eventFunction.php",
    {
      data,
      inputMonth,
      inputYear,
    },
    function (response) {
      response = $.parseJSON(response);

      let thead = `<tr class="table-dark">`;
      Object.values(response.week).forEach((value) => {
        thead += `
          <th scope="col" class="border-end border-light m-2 rounded" style="background-color: #45aaf2;">
            ${value}
          </th>`;
      });
      thead += `</tr>`;
      $("thead").empty().append(thead);

      let storeDay = 0;
      $("tbody").empty();

      while (storeDay < response.totalDay) {
        let tbody = `<tr class="table-dark">`;

        for (let dayCount = 0; dayCount < 7; dayCount++) {
          if (dayCount < response.day || storeDay >= response.totalDay) {
            tbody += `
              <th scope="col" class="border-end border-light m-2 rounded" style="background-color: ${dayCount == 6 ? '#f53b57' : ''};">
                <i class="bi bi-dash-lg"></i>
              </th>`;
          } else {
            storeDay++;
            const paddedStoreDay = String(storeDay).padStart(2, "0");
            const formattedDate = `${response.year}-${response.month}-${paddedStoreDay}`;
            const isToday = formattedDate === `${response.currentYear}-${response.currentMonth}-${response.currentDate}`;

            tbody += `
              <td scope="col" class="gate border-end border-light m-2 rounded" data-ddate="${formattedDate}" style="background-color: ${dayCount == 6 ? '#f53b57' : ''};">
                ${paddedStoreDay}${isToday ? "<br />Today" : ""}
              </td>`;

            if (storeDay >= response.totalDay) {
              break;
            }
          }
        }

        tbody += `</tr>`;
        $("tbody").append(tbody);
        response.day = 0;
      }

      $(".putMonth").val(response.month);
      $(".putYear").val(response.year);
      $(".putDate").html(` ${response.year}, ${response.monthInWords} `);
      $("#meetingDate").val(`${response.currentYear}-${response.currentMonth}-${response.currentDate}`);
    }
  );
}

