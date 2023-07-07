
$(document).on("click", "#csv", function() {
    console.log("Exporting revenue table as CSV...");
    $("#revenuetable").tableHTMLExport({ type: "csv", filename: "Revenue.csv" });
  });

  $(document).on("click", "#pdf", function() {
    console.log("Exporting revenue table as PDF...");
    $("#revenuetable").tableHTMLExport({ type: "pdf", filename: "Revenue.pdf" });
  });

  $(document).on("click", "#txt", function() {
    console.log("Exporting revenue table as TXT...");
    $("#revenuetable").tableHTMLExport({ type: "txt", filename: "Revenue.txt" });
  });

  $(document).on("click", "#print", function() {
    console.log("Printing revenue table...");
    var printContents = $(".table-responsive").html();
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  });