/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package library.models.entities;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Temporal;
import static javax.persistence.TemporalType.DATE;
import javax.xml.bind.annotation.XmlRootElement;

/*
* Classe LibraryUser (Entity)
*/

@Entity
public class LibraryUser extends Person implements Serializable {

    private static final long serialVersionUID = 1L;
    @Column(unique=true)
    private String login;
    private String password;
    private AccountType accountState;
    @Temporal(DATE)
    private Date lastConnection;
    private Boolean isAdmin;
    private List<Loan> loans;

    public LibraryUser(Long id, String firstName, String lastName, String gender, String profilePicture, String email, Date birthDate) {
        super(id, firstName, lastName, gender, profilePicture, email, birthDate);
        this.isAdmin = false;
        this.loans = new ArrayList<Loan>();
    }

    public LibraryUser(String login, String password, AccountType accountState, Date lastConnection, Long id, String firstName, String lastName, String gender, String profilePicture, String email, Date birthDate) {
        super(id, firstName, lastName, gender, profilePicture, email, birthDate);
        this.login = login;
        this.password = password;
        this.accountState = accountState;
        this.lastConnection = lastConnection;
        this.isAdmin = false;
        this.loans = new ArrayList<Loan>();
    }

    public LibraryUser(String login, String password, AccountType accountState, Date lastConnection, Long id, String firstName, String lastName, String gender, String profilePicture, String email, Date birthDate, Boolean isAdmin, List<Loan> loans) {
        super(id, firstName, lastName, gender, profilePicture, email, birthDate);
        this.login = login;
        this.password = password;
        this.accountState = accountState;
        this.lastConnection = lastConnection;
        this.isAdmin = isAdmin;
        this.loans = loans;
    }

    public LibraryUser() {
        super();
        this.isAdmin = false;
        this.loans = new ArrayList<Loan>();
    }

    public String getLogin() {
        return login;
    }

    public void setLogin(String login) {
        this.login = login;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public AccountType getAccountState() {
        return accountState;
    }

    public void setAccountState(AccountType accountState) {
        this.accountState = accountState;
    }

    public Date getLastConnection() {
        return lastConnection;
    }

    public void setLastConnection(Date lastConnection) {
        this.lastConnection = lastConnection;
    }

    public List<Loan> getLoans() {
        return loans;
    }

    public void setLoans(List<Loan> loans) {
        this.loans = loans;
    }

    public Boolean getIsAdmin() {
        return isAdmin;
    }

    public void setIsAdmin(Boolean isAdmin) {
        this.isAdmin = isAdmin;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (id != null ? id.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        
        if (!(object instanceof LibraryUser)) {
            return false;
        }
        LibraryUser other = (LibraryUser) object;
        if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "library.entities.User[ id=" + id + " ]";
    }
    
}
