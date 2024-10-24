document.addEventListener("DOMContentLoaded", function () {
    const countrySelect = document.getElementById("country-select");
    const countryDetails = document.querySelector(".country-details");

    countrySelect.addEventListener("change", function () {
        const selectedCountry = countrySelect.value;
        if (selectedCountry !== "") {
            // Fetch data related to the selected country and display it
            // We'll just use a simple object for demonstration purposes.
            const countryData = {
                selectcountry: {
                    name: "Country 1",
                    details: "Information about Country 1.",
                }
            };

            // Update the content of the "country-details" div with the fetched data.
            countryDetails.innerHTML = `<h2>${countryData[selectedCountry].name}</h2>
                                        <p>${countryData[selectedCountry].details}</p>`;

            // Show the "country-details" div.
            countryDetails.style.display = "block";
        } else {
            // Hide the "country-details" div if no country is selected.
            countryDetails.style.display = "none";
        }
    });
});
