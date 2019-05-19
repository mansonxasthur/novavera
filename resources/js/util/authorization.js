class User {
    constructor(user = null) {

        if (user) {
            this.id = user.id;
            this.name = user.name;
            this.role = user.role.name;
        } else {
            this.id = this.name = this.role = null;
        }

    }

    isSuper() {
        return this.role === 'super';
    }

    isAdmin() {
        return this.role === 'admin';
    }

    isSeo() {
        return this.role === 'seo';
    }

    isViewer() {
        return this.role === 'viewer';
    }
}

export default User;