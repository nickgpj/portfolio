using EindopdrachtDD1.Helpers;
using EindopdrachtDD1.View;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace EindopdrachtDD1.ViewModel
{
    public class ContactInfoViewModel : ObservableObject
    {
        #region fields
        private string _naam = null!;
        private string _telefoon = null!;
        private string _email = null!;
        #endregion

        #region constructors

        public ContactInfoViewModel()
        {
            Naam = "Nicholas";
            Telefoon = "0614044848";
            Email = "nicholas.poldermans@gmail.com";
        }
        #endregion

        #region properties
        public string Naam
        {
            get { return _naam; }
            set { _naam = value; }
        }

        public string Telefoon
        {
            get { return _telefoon; }
            set { _telefoon = value; }
        }

        public string Email
        {
            get { return _email; }
            set { _email = value; }
        }
        #endregion
    }
}
