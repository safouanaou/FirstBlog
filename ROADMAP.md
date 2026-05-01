# First Blog Roadmap

This roadmap covers the project from the current state up to security improvements.

## 1. Authentication Basics

Goal: make the user auth flow complete and reliable.

Steps:
- Finish `register.php` so users can create accounts successfully.
- Finish `login.php` so valid users can sign in and invalid logins show an error.
- Finish `logout.php` so the session is cleared and the user is redirected.
- Make sure `index.php` shows different navigation for logged-in and logged-out users.
- Test the full flow: register, login, logout, and refresh behavior.

## 2. Create Post

Goal: let a logged-in user publish a blog post.

Steps:
- Protect `create_post.php` so only logged-in users can access it.
- Build the form with a title field and content textarea.
- Validate that title and content are not empty.
- Insert the post into the `posts` table with:
  - `user_id` from `$_SESSION['user_id']`
  - `title` from the form
  - `content` from the form
- Redirect after a successful insert to avoid duplicate submissions on refresh.
- Preserve entered form values when validation fails.
- Show validation errors inside the page.

## 3. Homepage Post Listing

Goal: make the homepage behave like a real blog homepage.

Steps:
- Add a `Create Post` link to `index.php` for logged-in users.
- Load posts from the database in `index.php`.
- Show each post's title, content preview or full content, and creation date.
- Join `posts` with `users` so the author's username can be displayed.
- Show a friendly message when there are no posts yet.

## 4. Single Post Page

Goal: let users open one post on its own page.

Steps:
- Create a page such as `post.php`.
- Read the post id from the URL.
- Validate that the id exists and is usable.
- Query the database for that single post.
- Show a "post not found" message if the id is invalid or missing.
- Link to the single-post page from the homepage.

## 5. Edit Post

Goal: allow authors to update their own posts.

Steps:
- Create an edit page such as `edit_post.php`.
- Load the selected post from the database.
- Check that the logged-in user owns the post.
- Pre-fill the form with the existing title and content.
- Validate the submitted data.
- Update the post in the database.
- Redirect after a successful update.

## 6. Delete Post

Goal: allow authors to remove their own posts.

Steps:
- Add a delete action for posts.
- Check that the logged-in user owns the post before deleting it.
- Delete the selected post from the database.
- Redirect back to the homepage after deletion.
- Add a confirmation step in the UI so deletion is not accidental.

## 7. Ownership and Authorization

Goal: make sure users can only manage their own content.

Steps:
- Reuse the session-based login check on protected pages.
- Check post ownership on edit actions.
- Check post ownership on delete actions.
- Hide edit and delete controls from users who do not own a post.
- Handle unauthorized access with a redirect or a clear error message.

## 8. Better Validation and User Feedback

Goal: make the app feel more polished and harder to break.

Steps:
- Trim all submitted input.
- Require non-empty usernames, passwords, titles, and content.
- Add sensible length checks for usernames and titles.
- Show clear error messages near the related form.
- Preserve user input when validation fails.
- Add success messages where helpful.

## 9. Basic UI Polish

Goal: make the blog easier to use and easier to read.

Steps:
- Add consistent navigation links across pages.
- Improve spacing and form layout.
- Add headings and labels that make the page purpose obvious.
- Show the logged-in state more clearly.
- Make the homepage easier to scan.

## 10. Security Improvements

Goal: improve trustworthiness and reduce common beginner mistakes.

Steps:
- Escape output with `htmlspecialchars()` when printing user-generated content.
- Keep using prepared statements for all database queries involving user input.
- Avoid echoing raw database errors to users in production-style code.
- Improve connection error handling in `config.php`.
- Validate IDs from the URL before using them in queries.
- Add stricter validation rules for usernames, titles, and content length.
- Regenerate the session id after successful login.
- Add CSRF protection to forms that change data:
  - register
  - login
  - create post
  - edit post
  - delete post

## Suggested Build Order

1. Authentication basics
2. Create post
3. Homepage post listing
4. Single post page
5. Edit post
6. Delete post
7. Ownership and authorization
8. Better validation and user feedback
9. Basic UI polish
10. Security improvements
