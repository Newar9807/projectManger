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
      "tempFunction/ajaxHandler.php",
      {
        id: id,
        deleteMeeting: 1,
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
  // console.log(data);
  var inputMonth = $("#inputMonth").val();
  var inputYear = $("#inputYear").val();
  $.post(
    "usefulFunction/eventFunction.php",
    {
      data: data,
      inputMonth: inputMonth,
      inputYear: inputYear,
    },
    function (response) {
      response = $.parseJSON(response);

      // insert table head
      thead = `<tr class="table-dark">`;
      Object.entries(response.week).forEach((entry) => {
        const [key, value] = entry;
        thead +=
          `<th scope="col" class="border-end border-light m-2 rounded" style="background-color: #45aaf2;">` +
          value +
          `</th>`;
      });
      thead += `</tr>`;
      $("thead").empty().append(thead);

      var storeDay = 0;
      $("tbody").empty();
      var tbody = ``;
      while (storeDay < response.totalDay) {
        tbody = `<tr class="table-dark">`;
        dayCount = 0;
        while (dayCount < 7) {
          if (!(dayCount < response.day || storeDay > response.totalDay)) {
            storeDay++;
            // console.log(dayCount, storeDay);
            storeDay = String(storeDay).padStart(2, "0");
            // storeDay = sprintf("%02d", storeDay);
          }
          if (dayCount < response.day || storeDay > response.totalDay) {
            if (dayCount == 6) {
              tbody += `<th scope="col" class="border-end border-light table-dark mprojectID-2 rounded" style="background-color: #f53b57;"> <i class="bi bi-dash-lg"></i> </th>`;
            } else {
              tbody += `<th scope="col" class="border-end border-light m-2 rounded"> <i class="bi bi-dash-lg"></i> </th>`;
            }
          } else if (dayCount == 6) {
            tbody +=
              `<td scope="col" class="gate border-end border-light m-2 rounded" data-ddate="` +
              response.year +
              `-` +
              response.month +
              `-` +
              storeDay +
              `" style=" background-color: #f53b57;">` +
              storeDay;
            var temp = response.year + "-" + response.month + "-" + storeDay;
            var see =
              response.currentYear +
              "-" +
              response.currentMonth +
              "-" +
              response.currentDate;
            if (temp == see) {
              tbody += `<span style=''><br />Today</span>`;
            }
            tbody += `</td></tr>`;
            $("tbody").append(tbody);
            response.day = -1;
            break;
          } else {
            tbody +=
              `<td scope="col" class="gate border-end border-light m-2 rounded" data-ddate="` +
              response.year +
              `-` +
              response.month +
              `-` +
              storeDay +
              `">` +
              storeDay;
            // console.log(storeDay);
            var temp = response.year + "-" + response.month + "-" + storeDay;
            var see =
              response.currentYear +
              "-" +
              response.currentMonth +
              "-" +
              response.currentDate;
            if (temp == see) {
              tbody += `<span style=''><br />Today</span>`;
            }
            tbody += `</td>`;
          }
          dayCount++;
        }
        tbody += `</tr>`;
      }
      $("tbody").append(tbody);

      $(".putMonth").val(response.month);
      $(".putYear").val(response.year);
      $(".putDate").html(
        " " + response.year + ", " + response.monthInWords + " "
      );
      $("#meetingDate").val(
        response.currentYear +
          "-" +
          response.currentMonth +
          "-" +
          response.currentDate
      );
    }
  );
}
