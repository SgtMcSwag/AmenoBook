/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package library.services;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.List;
import javax.ejb.EJB;
import javax.ejb.Stateless;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.FormParam;
import javax.ws.rs.WebApplicationException;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import library.models.IServiceModel;
import library.models.entities.AccountType;
import library.models.entities.Author;
import library.models.entities.Book;
import library.models.entities.Category;
import library.models.entities.LibraryUser;
import library.models.entities.Loan;
import library.models.entities.TypeAuthor;

/*
* Classe LibraryRESTFulService (Stateless)
*/

@Stateless
@Path("rest")
public class LibraryRESTFulService {
    
    @EJB
    private IServiceModel metier;
    
    //Author
    @POST
    @Path("/authors/add")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Author addAuthor(
        @FormParam("about") String about,
        @FormParam("birthdate") String birthdate,
        @FormParam("email") String email,
        @FormParam("firstname") String firstname,
        @FormParam("gender") String gender,
        @FormParam("lastname") String lastname,
        @FormParam("nationality") String nationality,
        @FormParam("profilepicture") String profilepicture,
        @FormParam("type")int type){
        
        Author author = new Author();
        author.setAbout(about);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        author.setBirthDate(spl.parse(birthdate));
        }catch(Exception e){
            e.printStackTrace();
        }
        author.setEmail(email);
        author.setFirstName(firstname);
        author.setGender(gender);
        author.setLastName(lastname);
        author.setNationality(nationality);
        author.setProfilePicture(profilepicture);
        author.setType(TypeAuthor.values()[type]);
        author = metier.addAuthor(author);
        
        if(author == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return author;
    }
    
    @GET
    @Path("/authors")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Author> getAllAuthors(){
        List<Author> list = null;
        list = metier.getAllAuthors();
        if(list == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return list;
    }
            
            
    @GET
    @Path("/authors/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Author getAuthorById(
        @PathParam(value="id")int id){
        Author author = null;
        author = metier.getAuthorById(id);
        if(author == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return author;
    }
    
    @POST
    @Path("/authors/update/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Author updateAuthor(@FormParam(value="id")int id,
        @FormParam(value="about")String about,
        @FormParam(value="birthdate")String birthdate,
        @FormParam(value="email")String email,
        @FormParam(value="firstname")String firstname,
        @FormParam(value="gender")String gender,
        @FormParam(value="lastname")String lastname,
        @FormParam(value="nationality")String nationality,
        @FormParam(value="profilepicture")String profilepicture,
        @FormParam(value="type")int type){
        Author author = metier.getAuthorById(id);
        
        author.setAbout(about);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        author.setBirthDate(spl.parse(birthdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        author.setEmail(email);
        author.setFirstName(firstname);
        author.setGender(gender);
        author.setLastName(lastname);
        author.setNationality(nationality);
        author.setProfilePicture(profilepicture);
        author.setType(TypeAuthor.values()[type]);
        metier.updateAuthor(author);
        
        return author;
    }
    
    @DELETE
    @Path("/authors/delete/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public boolean deleteAuthor(@PathParam(value="id")int id){
        Author author = metier.getAuthorById(id);
        if(author != null){
            metier.deleteAuthor(author);
            return true;
        }else{
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
    }
   //End Author
    
    //Book
    @POST
    @Path("/books/add")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Book addBook(@FormParam(value="isbn")String isbn,
            @FormParam(value="picture")String picture,
            @FormParam(value="publicationdate")String publicationdate,
            @FormParam(value="quantity")int quantity,
            @FormParam(value="resume")String resume,
            @FormParam(value="title")String title,
            @FormParam(value="category_id")int category_id){
        Book book = new Book();
        
        book.setIsbn(isbn);
        book.setPicture(picture);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        book.setPublicationDate(spl.parse(publicationdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        book.setQuantity(quantity);
        book.setResume(resume);
        book.setTitle(title);
        book.setCategory(metier.getCategoryById(category_id));
        
        book = metier.addBook(book);
        if(book == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return book;
    }
    
    @GET
    @Path("/books/")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Book> getAllBooks(){
        List<Book> books = null;
        books = metier.getAllBooks();
        if(books == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return books;
    }
    
    @GET
    @Path("/books/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Book getBookById(@PathParam(value="id")int id){
        Book book = null;
        book = metier.getBookById(id);
        if(book == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return book;
    }
    
    @GET
    @Path("/categories/{id}/books/")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Book> getBooksByCategory(@PathParam(value="id")int id){
        Category cat = null;
        cat = metier.getCategoryById(id);
        if(cat == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        List<Book> books = null;
        books = metier.getBooksByCategory(cat);
        if(books == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return books;
    }
    
    @POST
    @Path("/books/update/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Book updateBook(@FormParam(value="id")int id,
            @FormParam(value="isbn")String isbn,
            @FormParam(value="picture")String picture,
            @FormParam(value="publicationdate")String publicationdate,
            @FormParam(value="quantity")int quantity,
            @FormParam(value="resume")String resume,
            @FormParam(value="title")String title,
            @FormParam(value="category_id")int category_id){
        Book book = metier.getBookById(id);
       
        book.setIsbn(isbn);
        book.setPicture(picture);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        book.setPublicationDate(spl.parse(publicationdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        book.setQuantity(quantity);
        book.setResume(resume);
        book.setTitle(title);
        book.setCategory(metier.getCategoryById(category_id));
        
        metier.updateBook(book);
        return book;
    }
    
    @DELETE
    @Path("/books/delete/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public boolean deleteBook(@PathParam(value="id")int id){
        Book book = metier.getBookById(id);
        if(book != null){
            metier.deleteBook(book);
            return true;
        }else{
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
    }
    //End Book
    
    @GET
    @Path("/categories")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Category> getAllCategory(){
        List<Category> cats = null;
        cats = metier.getAllCategory();
        if(cats == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return cats;
    }

    @GET
    @Path("/categories/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Category getCategoryById(@PathParam(value="id")int id){
        Category cat = null;
        cat = metier.getCategoryById(id);
        if(cat == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return cat;
    }
    
    @POST
    @Path("/categories/update/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Category updateCategory(@FormParam(value="id")int id,
            @FormParam(value="description")String description,
            @FormParam(value="name")String name){
        Category cat = metier.getCategoryById(id);
        
        cat.setDescription(description);
        cat.setName(name);
        
        metier.updateCategory(cat);
        return cat;
    }
    
    @DELETE
    @Path("/categories/delete/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public boolean deleteCategory(@PathParam(value="id")int id){
        Category cat = null;
        cat = metier.getCategoryById(id);
        if(cat != null){
            metier.deleteCategory(cat);
            return true;
        }else{
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
    }
    
    @POST
    @Path("/categories/add")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Category addCategory(@FormParam(value="description")String description,
            @FormParam(value="name")String name){
        Category cat = new Category();
        
        cat.setDescription(description);
        cat.setName(name);
        
        cat = metier.addCategory(cat);
        if(cat == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return cat;
    }
    //End Category
    
    //UserLibrary
    @GET
    @Path("/users")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<LibraryUser> getAllLibraryUsers(){
        List<LibraryUser> users = null;
        users = metier.getAllLibraryUsers();
        if(users == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return users;
    }
    
    @GET
    @Path("/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public LibraryUser getLibraryUserById(@PathParam(value="id")int id){
        LibraryUser user = null;
        user = metier.getLibraryUserById(id);
        if(user == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return user;
    }
    
    @POST
    @Path("/users/update/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public LibraryUser updateUser(@FormParam(value="id")int id,
            @FormParam(value="accountstate")int accountstate,
            @FormParam(value="birthdate")String birthdate,
            @FormParam(value="email")String email,
            @FormParam(value="firstname")String firstname,
            @FormParam(value="gender")String gender,
            @FormParam(value="isadmin")boolean isadmin,
            @FormParam(value="lastconnection")String lastconnection,
            @FormParam(value="lastname")String lastname,
            @FormParam(value="login")String login,
            @FormParam(value="password")String password,
            @FormParam(value="profilepicture")String profilepicture){
        LibraryUser user = metier.getLibraryUserById(id);
        
        user.setAccountState(AccountType.values()[accountstate]);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        user.setBirthDate(spl.parse(birthdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        user.setEmail(email);
        user.setFirstName(firstname);
        user.setGender(gender);
        user.setIsAdmin(isadmin);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        user.setLastConnection(spl.parse(lastconnection));
        }catch(ParseException e){
            e.printStackTrace();
        }
        user.setLastName(lastname);
        user.setLogin(login);
        user.setPassword(password);
        user.setProfilePicture(profilepicture);
        
        metier.updateUser(user);
        return user;
    }
    
    @DELETE
    @Path("/users/delete/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public boolean deleteUser(@PathParam(value="id")int id){
        LibraryUser user = null;
        user = metier.getLibraryUserById(id);
        if(user != null){
            metier.deleteUser(user);
            return true;
        }else{
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
    }
    
    @POST
    @Path("/connect")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public LibraryUser connect(@FormParam(value="login")String login, @FormParam(value="password")String password){
        LibraryUser ret = null;
        ret = metier.connect(login, password);
        if(ret == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return ret;
    }
    //End UserLibrary
    
    //Loan
    @POST
    @Path("/users/add")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public LibraryUser addUser(@FormParam(value="accountstate")int accountstate,
            @FormParam(value="birthdate")String birthdate,
            @FormParam(value="email")String email,
            @FormParam(value="firstname")String firstname,
            @FormParam(value="gender")String gender,
            @FormParam(value="isadmin")boolean isadmin,
            @FormParam(value="lastconnection")String lastconnection,
            @FormParam(value="lastname")String lastname,
            @FormParam(value="login")String login,
            @FormParam(value="password")String password,
            @FormParam(value="profilepicture")String profilepicture){
        List<LibraryUser> listUsers = metier.getAllLibraryUsers();
        for(LibraryUser user : listUsers){
            if(user.getLogin().equals(login)){
                throw new WebApplicationException(Response.Status.NOT_FOUND);
            }
        }
        
        LibraryUser user = new LibraryUser();
        
        user.setAccountState(AccountType.values()[accountstate]);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        user.setBirthDate(spl.parse(birthdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        user.setEmail(email);
        user.setFirstName(firstname);
        user.setGender(gender);
        user.setIsAdmin(isadmin);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        user.setLastConnection(spl.parse(lastconnection));
        }catch(ParseException e){
            e.printStackTrace();
        }
        user.setLastName(lastname);
        user.setLogin(login);
        user.setPassword(password);
        user.setProfilePicture(profilepicture);
        
        user = metier.addUser(user);
        if(user == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return user;
    }
    
    @GET
    @Path("/{userId}/loans")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Loan> getListLoanByUser(@PathParam(value="userId")int userId){
        List<Loan> loans = null;
        loans = metier.getListLoanByUser(userId);
        if(loans == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return loans;
    }
    
    @GET
    @Path("/loans")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public List<Loan> getAllLoans(){
        List<Loan> loans = null;
        loans = metier.getAllLoans();
        if(loans == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return loans;
    }
    
    @POST
    @Path("/loans/add")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Loan addLoan(@FormParam(value="duration")int duration,
            @FormParam(value="isreturned")boolean isreturned,
            @FormParam(value="startdate")String startdate,
            @FormParam(value="book")int book,
            @FormParam(value="libraryuser")int libraryuser){
        Loan loan = new Loan();
        
        loan.setDuration(duration);
        loan.setIsReturned(isreturned);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        loan.setStartDate(spl.parse(startdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        loan.setBorrowedBook(metier.getBookById(book));
        loan.setUser(metier.getLibraryUserById(libraryuser));
        
        loan = metier.addLoan(loan);
        if(loan == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return loan;
    }
    
    @POST
    @Path("/loans/update/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Loan updateLoan(@FormParam(value="id")int id,
            @FormParam(value="duration")int duration,
            @FormParam(value="isreturned")boolean isreturned,
            @FormParam(value="startdate")String startdate,
            @FormParam(value="book")int book,
            @FormParam(value="libraryuser")int libraryuser){
        Loan loan = metier.getLoanById(id);
        
        loan.setDuration(duration);
        loan.setIsReturned(isreturned);
        try{
        SimpleDateFormat spl = new SimpleDateFormat("dd/MM/yyyy");
        loan.setStartDate(spl.parse(startdate));
        }catch(ParseException e){
            e.printStackTrace();
        }
        loan.setBorrowedBook(metier.getBookById(book));
        loan.setUser(metier.getLibraryUserById(libraryuser));
        
        metier.updateLoan(loan);
        return loan;
    }
    @DELETE
    @Path("/loans/delete/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public boolean deleteLoan(@PathParam(value="id")int id){
        Loan loan = null;
        loan = metier.getLoanById(id);
        if(loan != null){
            metier.deleteLoan(loan);
            return true;
        }else{
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
    }
    
    @GET
    @Path("/loans/{id}")
    @Produces({MediaType.APPLICATION_JSON, MediaType.APPLICATION_XML})
    public Loan getLoanById(@PathParam(value="id")int id){
        Loan loan = null;
        loan = metier.getLoanById(id);
        if(loan == null){
            throw new WebApplicationException(Response.Status.NOT_FOUND);
        }
        return loan;
    }
    //End Loan
}
