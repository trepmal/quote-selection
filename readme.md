# Quote Selection

Proof of Concept version. Needs polishing, hooks, escaping, etc.

Adds a button above the concept for that says **Quote Selection** Upon pressing, whatever text on the page has been highlighted will be wrapped in a `<blockquote>`* and appended to the comment box.

\* unless that tag isn't allowed or if no text has been selected

**Things I'd like to get around to adding**

- translatable strings
- better UI when there's no selection (change visibility? change state?) 
- review javascript for performance, etc
- browser compat checking