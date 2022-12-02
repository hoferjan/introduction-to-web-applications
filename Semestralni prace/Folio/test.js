function validateEmail("xdd@xdd.cz") {
    const re = /^\S+@\S+$/;
    return re.test(String(email).toLowerCase());
  }