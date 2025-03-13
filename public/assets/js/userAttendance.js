document.addEventListener("DOMContentLoaded", () => {
    // Elements
    const absentModal = document.getElementById("absentModal")
    const closeModalBtn = document.getElementById("closeAddUserModal")
    const closeAbsentBtn = document.getElementById("closeAbsentButton")
    const absentForm = document.getElementById("absentForm")
    const permitRadio = document.getElementById("permit")
    const sickRadio = document.getElementById("sick")

    // Show modal function (to be called from your main page)
    window.showAbsentModal = () => {
      absentModal.classList.remove("hidden")
      absentModal.classList.add("flex")
      document.body.classList.add("overflow-hidden")

      // Add fade-in animation
      setTimeout(() => {
        absentModal.querySelector(".animate-fade-in").classList.add("opacity-100")
      }, 10)
    }

    // Hide modal function
    function hideModal() {
      absentModal.querySelector(".animate-fade-in").classList.remove("opacity-100")
      setTimeout(() => {
        absentModal.classList.remove("flex")
        absentModal.classList.add("hidden")
        document.body.classList.remove("overflow-hidden")

        // Reset form
        absentForm.reset()
        placementContainer.classList.add("hidden", "opacity-0")
      }, 200)
    }

    // Event listeners
    if (closeModalBtn) closeModalBtn.addEventListener("click", hideModal)
    if (closeAbsentBtn) closeAbsentBtn.addEventListener("click", hideModal)

    // Close modal when clicking outside
    absentModal.addEventListener("click", (e) => {
      if (e.target === absentModal) {
        hideModal()
      }
    })

    // Show placement field when "Permit" is selected
    if (permitRadio) {
      permitRadio.addEventListener("change", function () {
        if (this.checked) {
          placementContainer.classList.remove("hidden")
          setTimeout(() => {
            placementContainer.classList.remove("opacity-0")
          }, 10)
        }
      })
    }

    // Hide placement field when "Sick" is selected
    if (sickRadio) {
      sickRadio.addEventListener("change", function () {
        if (this.checked) {
          placementContainer.classList.add("opacity-0")
          setTimeout(() => {
            placementContainer.classList.add("hidden")
          }, 300)
        }
      })
    }

    // Form submission with validation
    if (absentForm) {
      absentForm.addEventListener("submit", function (e) {
        e.preventDefault()

        // Basic validation
        const absenceType = document.querySelector('input[name="absenceType"]:checked')
        const note = document.getElementById("note").value.trim()

        if (!absenceType) {
          showError("Please select an absence type")
          return
        }

        if (!note) {
          showError("Please provide a reason for your absence")
          return
        }

        // If permit is selected, validate placement
        if (absenceType.value === "permit") {
          const placement = document.getElementById("placement").value
          if (!placement && !document.getElementById("placement").disabled) {
            showError("Please select a placement location")
            return
          }
        }

        // Submit the form
        this.submit()
      })
    }

    // Error message function
    function showError(message) {
      // You can implement your preferred error display method here
      // For example, a toast notification or inline error
      alert(message)
    }
  })

