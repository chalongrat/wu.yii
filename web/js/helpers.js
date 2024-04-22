// Define a function to convert English month abbreviation to Thai
function monthToThai_Long(month) {
    const monthMap = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

    return monthMap[month];
}

function monthToThai_Shot(month) {
    const monthMap = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];

    return monthMap[month];
}

function monthToEng_Long(month) {
    const monthMap = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    return monthMap[month];
}

function monthToEng_Shot(month) {
    const monthMap = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    return monthMap[month];
}

function formatDateENtoTH(date) {
    if (date) {
        const [year, monthAbbr, day] = date.split("-");

        // Convert the English month abbreviation to Thai
        const thaiMonth = monthToThai_Shot(parseInt(monthAbbr));

        // Convert the year to Thai year (Buddhist calendar)
        const thaiYear = parseInt(year) + 543;

        // Construct the Thai date string
        const thaiDate = `${day} ${thaiMonth} ${thaiYear}`;

        return thaiDate;
    } else {
        return "";
    }
}

function formatDateByLang(date, lang) {
    if (date && lang) {
        let [year, monthAbbr, day] = date.split("-");
        let thaiMonth = "";
        let thaiYear = "";

        if (lang == "th") {
            thaiMonth = monthToThai_Shot(parseInt(monthAbbr));
            thaiYear = parseInt(year) + 543;
        } else {
            thaiMonth = monthToEng_Shot(parseInt(monthAbbr));
            thaiYear = parseInt(year);
        }

        return `${day} ${thaiMonth} ${thaiYear}`;
    } else return "";
}

function formatDateNumByLang(date, lang) {
    if (date && lang) {
        let [year, monthAbbr, day] = date.split("-");
        return `${day}/${monthAbbr}/${lang == "th" ? parseInt(year) + 543 : year}`;
    } else return "";
}

function dateByLangForSave(date, lang) {
    // format send to save "2024-04-04"
    if (date && lang) {
        let [day, monthAbbr, year] = date.split("/");
        return `${lang == "th" ? parseInt(year) - 543 : year}-${monthAbbr}-${day}`;
    } else return "";
}
