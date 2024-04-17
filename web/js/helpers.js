// Define a function to convert English month abbreviation to Thai
function convertMonthToThai_Long(month) {
    const monthMap = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

    return monthMap[month];
}

function convertMonthToThai_Shot(month) {
    const monthMap = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];

    return monthMap[month];
}

function formatDateENtoTH(date) {
    const [year, monthAbbr, day] = date.split("-");

    // Convert the English month abbreviation to Thai
    const thaiMonth = convertMonthToThai_Shot(parseInt(monthAbbr));

    // Convert the year to Thai year (Buddhist calendar)
    const thaiYear = parseInt(year) + 543;

    // Construct the Thai date string
    const thaiDate = `${day} ${thaiMonth} ${thaiYear}`;

    return thaiDate;
}
