document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(e) {
        if (e.target.closest('.like-btn')) {
            const button = e.target.closest('.like-btn');
            const postId = button.dataset.postId;
            const isLiked = button.classList.contains('btn-primary');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Use correct endpoint based on action
            const endpoint = isLiked ? `/posts/${postId}/unlike` : `/posts/${postId}/like`;
            const method = isLiked ? 'DELETE' : 'POST';

            // Add loading state
            button.disabled = true;
            const originalText = button.querySelector('.like-text').textContent;
            button.querySelector('.like-text').textContent = isLiked ? 'Unliking...' : 'Liking...';

            fetch(endpoint, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                // Update button appearance
                button.classList.toggle('btn-primary');
                button.classList.toggle('btn-outline-secondary');
                
                // Update button text
                button.querySelector('.like-text').textContent = isLiked ? 'Like' : 'Liked';
                
                // Update likes count in the stats section
                const likesCountElement = document.querySelector(`[data-post-likes="${postId}"] .likes-count`);
                if (likesCountElement) {
                    likesCountElement.textContent = data.likes_count;
                } else {
                    console.warn('Likes count element not found');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert button text on error
                button.querySelector('.like-text').textContent = originalText;
                alert('Error: ' + error.message);
            })
            .finally(() => {
                button.disabled = false;
            });
        }
    });
});