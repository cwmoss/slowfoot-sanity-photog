import React from 'react'
import PropTypes from 'prop-types'
import getIt from 'get-it'
import jsonResponse from 'get-it/lib/middleware/jsonResponse'
// const observable = require('get-it/lib/middleware/observable')
import promise from 'get-it/lib/middleware/promise'
import Button from 'part:@sanity/components/buttons/default'

import Spinner from 'part:@sanity/components/loading/spinner'

import styles from './deploy-website.css'

/*
const request = getIt([promise(), jsonResponse()])
request.use(
  observable({
    implementation: require('zen-observable')
  })
)
*/
const request = getIt()
/*request.use(
  observable({
    implementation: require('zen-observable')
  })
)*/



class DeployWebsite extends React.Component {
  static propTypes = {
    imageWidth: PropTypes.number
  }

  static defaultProps = {
    imageWidth: 600
  }

  state = {
    imageUrl: null,
    outp: null,
    error: null,
    loading: false
  }
  deploy = () => {
    var me = this
    const xhr = new XMLHttpRequest()
    console.log("+++ widget options", this.props)
    me.setState({loading: true})

    xhr.open("POST", this.props.site.url, true)

    xhr.onprogress = function(e) {
     console.log("progress")
     console.log(e)
     // node.textContent = e.currentTarget.responseText
     // var html = ansi_up.ansi_to_html(e.currentTarget.responseText)
     var outp = e.currentTarget.responseText
     // html = convert_html.toHtml(e.currentTarget.responseText)
     console.log(outp)
     me.setState({outp})
     me.refs.owindow.scrollTop = me.refs.owindow.scrollHeight
     //node.innerHTML = html
     //node.scrollTop = node.scrollHeight;
    }
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE) { // && xhr.status === 200
        me.setState({loading: false})
      }
    }
    xhr.send()
    /*request({url: BBASE})
      .filter(ev => ev.type === 'progress')
      .subscribe({
        next: res => console.log(res.body),
        error: err => console.error(err)
      })
    */
    /*
    request({url: 'https://api.thecatapi.com/v1/images/search'})
      .then(response => {
        const imageUrl = response.body[0].url
        this.setState({imageUrl})
      })
      .catch(error => this.setState({error}))
      */
  }

  componentDidMount() {
   // this.getCat()
  }

  render() {
    const {imageUrl, outp, error} = this.state
    const {site} = this.props
    console.log(this.props)

    if (error) {
      return <pre>{JSON.stringify(error, null, 2)}</pre>
    }
    const spin = <Spinner inline={true} />
    const {imageWidth} = this.props
    return (
      <div className={styles.container}>
        <header className={styles.header}>
          <h2 className={styles.title}>Seite aktualisieren: {site.name} { this.state.loading ? spin : null }</h2>
        </header>
        
        <div className={styles.footer}>
            <Button bleed color="primary" kind="simple" onClick={this.deploy}>
              publish
            </Button>
          </div>

          <div ref="owindow" className={styles.content}>
          <div dangerouslySetInnerHTML={{ __html: outp }} />
        </div>
      </div>
    )
  }
}

export default {
  name: 'deploy-website',
  component: DeployWebsite
}
