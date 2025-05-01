// Wait for DOM content to load
document.addEventListener('DOMContentLoaded', function() {
    // Get filter elements
    const filterType = document.getElementById('filter-type');
    const filterAge = document.getElementById('filter-age');
    const filterGender = document.getElementById('filter-gender');
    const filterButton = document.querySelector('.filter-button');
    
    // Add event listener to the filter button
    filterButton.addEventListener('click', applyFilters);
    
    // Function to apply filters
    function applyFilters() {
        // Get current URL and create URLSearchParams object
        const currentUrl = new URL(window.location.href);
        const searchParams = currentUrl.searchParams;
        
        // Update or add parameters based on filter values
        if (filterType.value) {
            searchParams.set('type', filterType.value);
        } else {
            searchParams.delete('type');
        }
        
        if (filterAge.value) {
            searchParams.set('age', filterAge.value);
        } else {
            searchParams.delete('age');
        }
        
        if (filterGender.value) {
            searchParams.set('gender', filterGender.value);
        } else {
            searchParams.delete('gender');
        }
        
        // Redirect to the new URL with applied filters
        window.location.href = currentUrl.toString();
    }
    
    // Enable pressing Enter key in filter fields to apply filters
    [filterType, filterAge, filterGender].forEach(filter => {
        filter.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });
    });
    
    // Add hover effect animation to pet cards
    const petCards = document.querySelectorAll('.pet-card');
    
    petCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const nameElement = this.querySelector('.pet-name');
            nameElement.classList.add('name-highlight');
        });
        
        card.addEventListener('mouseleave', function() {
            const nameElement = this.querySelector('.pet-name');
            nameElement.classList.remove('name-highlight');
        });
    });
});