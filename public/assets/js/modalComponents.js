document.addEventListener("DOMContentLoaded", function () {
    const placementSelect = document.getElementById("placement");
    if (!placementSelect) {
        return;
    } else {
        // Fetch data dari endpoint
        fetch("/users/getPlacements")
            .then((response) => {
                if (!response.ok) {
                    throw new Error(
                        "Network response was not ok " + response.statusText
                    );
                }
                return response.json();
            })
            .then((data) => {
                // Bersihkan opsi lama (jika ada)
                // console.log(data);
                placementSelect.innerHTML =
                    '<option selected hidden value="">Choose placement</option>';

                // Tambahkan opsi baru
                data.forEach((placement) => {
                    const option = document.createElement("option");
                    option.value = placement.id;
                    option.textContent = placement.name;
                    placementSelect.appendChild(option);
                });
            })
            .catch((error) => {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            });
    }
});
